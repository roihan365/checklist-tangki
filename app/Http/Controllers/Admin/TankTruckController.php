<?php

namespace App\Http\Controllers\Admin;

use App\Models\TankTruck;
use App\Models\User;
use App\Models\TankTruckDocument;
use App\Models\TankTruckHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class TankTruckController extends Controller
{
    public function index(Request $request)
    {
        $query = TankTruck::with(['distributor', 'documents'])
            ->latest();

        // Filter by distributor
        if ($request->has('distributor_id')) {
            $query->where('distributor_id', $request->distributor_id);
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Search by plate number or other fields
        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('plat_nomor', 'like', '%' . $request->search . '%')
                    ->orWhere('nomor_lambung', 'like', '%' . $request->search . '%')
                    ->orWhere('merk', 'like', '%' . $request->search . '%')
                    ->orWhere('tipe', 'like', '%' . $request->search . '%');
            });
        }

        $tankTrucks = $query->paginate(20);
        $distributors = User::role('admin-distributor')->get();
        $statuses = [
            'aktif' => 'Aktif',
            'nonaktif' => 'Nonaktif',
            'dalam_perbaikan' => 'Dalam Perbaikan'
        ];

        return view('pages.admin.tank-truck.index', compact('tankTrucks', 'distributors', 'statuses'));
    }

    public function create()
    {
        $distributors = User::role('admin-distributor')->get();
        $statuses = [
            'aktif' => 'Aktif',
            'nonaktif' => 'Nonaktif',
            'dalam_perbaikan' => 'Dalam Perbaikan'
        ];

        return view('pages.admin.tank-truck.create', compact('distributors', 'statuses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'plat_nomor' => 'required|string|max:15|unique:tank_trucks',
            'nomor_lambung' => 'required|string|max:20',
            'jenis_kendaraan' => 'required|string|max:50',
            'merk' => 'required|string|max:50',
            'tipe' => 'required|string|max:50',
            'tahun_pembuatan' => 'required|integer|min:1990|max:' . (date('Y') + 1),
            'warna' => 'required|string|max:30',
            'kapasitas' => 'required|numeric|min:1000',
            'nomor_rangka' => 'required|string|max:50',
            'nomor_mesin' => 'required|string|max:50',
            'distributor_id' => 'required|exists:users,id',
            'status' => 'required|in:aktif,nonaktif,dalam_perbaikan',
            'tanggal_aktif' => 'nullable|date',
            'tanggal_nonaktif' => 'nullable|date|after_or_equal:tanggal_aktif',
            'keterangan' => 'nullable|string'
        ]);

        $tankTruck = TankTruck::create($validated);

        // Log history
        TankTruckHistory::create([
            'tank_truck_id' => $tankTruck->id,
            'aktivitas' => 'Pendaftaran Kendaraan',
            'deskripsi' => 'Kendaraan baru didaftarkan ke sistem',
            'user_id' => Auth::id(),
            'metadata' => $validated
        ]);

        return redirect()->route('admin.tank-trucks.index')
            ->with('success', 'Data mobil tangki berhasil ditambahkan');
    }

    public function show(TankTruck $tankTruck)
    {
        $documents = $tankTruck->documents()->latest()->get();
        $histories = $tankTruck->histories()->paginate(10);

        return view('pages.admin.tank-truck.show', compact('tankTruck', 'documents', 'histories'));
    }

    public function edit(TankTruck $tankTruck)
    {
        $distributors = User::role('admin-distributor')->get();
        $statuses = [
            'aktif' => 'Aktif',
            'nonaktif' => 'Nonaktif',
            'dalam_perbaikan' => 'Dalam Perbaikan'
        ];
        return view('pages.admin.tank-truck.create', compact('tankTruck', 'distributors', 'statuses'));
    }

    public function update(Request $request, TankTruck $tankTruck)
    {
        $validated = $request->validate([
            'plat_nomor' => 'required|string|max:15|unique:tank_trucks,plat_nomor,' . $tankTruck->id,
            'nomor_lambung' => 'required|string|max:20',
            'jenis_kendaraan' => 'required|string|max:50',
            'merk' => 'required|string|max:50',
            'tipe' => 'required|string|max:50',
            'tahun_pembuatan' => 'required|integer|min:1990|max:' . (date('Y') + 1),
            'warna' => 'required|string|max:30',
            'kapasitas' => 'required|numeric|min:1000',
            'nomor_rangka' => 'required|string|max:50',
            'nomor_mesin' => 'required|string|max:50',
            'distributor_id' => 'required|exists:users,id',
            'status' => 'required|in:aktif,nonaktif,dalam_perbaikan',
            'tanggal_aktif' => 'nullable|date',
            'tanggal_nonaktif' => 'nullable|date|after_or_equal:tanggal_aktif',
            'keterangan' => 'nullable|string'
        ]);

        $tankTruck->update($validated);

        // Log history
        TankTruckHistory::create([
            'tank_truck_id' => $tankTruck->id,
            'aktivitas' => 'Pembaruan Data',
            'deskripsi' => 'Data kendaraan diperbarui',
            'user_id' => Auth::id(),
            'metadata' => $validated
        ]);

        return redirect()->route('admin.tank-trucks.index')
            ->with('success', 'Data mobil tangki berhasil diperbarui');
    }

    public function destroy(TankTruck $tankTruck)
    {
        // Log history before delete
        TankTruckHistory::create([
            'tank_truck_id' => $tankTruck->id,
            'aktivitas' => 'Penghapusan Data',
            'deskripsi' => 'Kendaraan dihapus dari sistem',
            'user_id' => Auth::id(),
            'metadata' => $tankTruck->toArray()
        ]);

        $tankTruck->delete();

        return redirect()->route('admin.tank-trucks.index')
            ->with('success', 'Data mobil tangki berhasil dihapus');
    }

    public function documentForm(TankTruck $tankTruck)
    {
        return view('pages.admin.tank-truck.document', compact('tankTruck'));
    }

    public function storeDocument(Request $request, TankTruck $tankTruck)
    {
        $validated = $request->validate([
            'jenis_dokumen' => 'required|string|max:50',
            'nomor_dokumen' => 'required|string|max:50',
            'tanggal_terbit' => 'required|date',
            'tanggal_kadaluarsa' => 'required|date|after:tanggal_terbit',
            'file_path' => 'required|file|mimes:pdf|max:10240',
            'catatan' => 'nullable|string|max:500',
        ]);

        // Store the file
        $path = $request->file('file_path')->store('tank-truck-documents', 'public');

        $document = $tankTruck->documents()->create([
            'jenis_dokumen' => $validated['jenis_dokumen'],
            'nomor_dokumen' => $validated['nomor_dokumen'],
            'tanggal_terbit' => $validated['tanggal_terbit'],
            'tanggal_kadaluarsa' => $validated['tanggal_kadaluarsa'],
            'file_path' => $path,
            'catatan' => $validated['catatan'],
            'status' => 'pending',
        ]);

        // Log history
        TankTruckHistory::create([
            'tank_truck_id' => $document->tank_truck_id,
            'aktivitas' => 'Upload Dokumen',
            'deskripsi' => 'Dokumen ' . $document->jenis_dokumen . ' ' . 'berhasil diupload',
            'user_id' => Auth::id(),
            'metadata' => [
                'document_id' => $document->id,
                'status' => $document->status,
                'catatan' => $validated['catatan'] ?? null
            ]
        ]);

        return redirect()->route('admin.tank-trucks.show', $tankTruck)
            ->with('success', 'Dokumen berhasil diupload dan menunggu verifikasi');
    }

    public function documentReview(Request $request, TankTruckDocument $document)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
            'catatan' => 'required_if:status,rejected|nullable|string|max:500',
        ]);

        $document->update([
            'status' => $validated['status'],
            'catatan' => $validated['catatan'] ?? null,
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now()
        ]);

        // Log history
        TankTruckHistory::create([
            'tank_truck_id' => $document->tank_truck_id,
            'aktivitas' => 'Verifikasi Dokumen',
            'deskripsi' => 'Truk ' . $document->tankTruck->plat_nomor . ' Dokumen ' . $document->jenis_dokumen . ' ' . $validated['status'],
            'user_id' => Auth::id(),
            'metadata' => [
                'document_id' => $document->id,
                'status' => $validated['status'],
                'catatan' => $validated['catatan'] ?? null
            ]
        ]);

        return back()->with('success', 'Status dokumen berhasil diperbarui');
    }
}
