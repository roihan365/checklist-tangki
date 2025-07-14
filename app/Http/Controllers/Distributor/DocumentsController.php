<?php

namespace App\Http\Controllers\Distributor;

use App\Models\TankTruck;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Histories;
use App\Models\TankTruckHistory;

class DocumentsController extends Controller
{
    public function index(Request $request)
    {
        $query = TankTruck::where('distributor_id', auth()->id())
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

        return view('pages.distributor.document.index', compact('tankTrucks', 'distributors', 'statuses'));
    }

    public function show(TankTruck $tankTruck)
    {
        $documents = $tankTruck->documents()->latest()->get();
        $histories = $tankTruck->histories()->paginate(10);

        return view('pages.distributor.document.show', compact('tankTruck', 'documents', 'histories'));
    }

    public function history()
    {
        $tankTrucks = TankTruck::where('distributor_id', auth()->id())
            ->latest()
            ->pluck('id');
        $histories = TankTruckHistory::with('user')->whereIn('tank_truck_id', $tankTrucks)
            ->latest()
            ->paginate(20);

        return view('pages.distributor.document.history', compact('histories'));
    }

    public function rejected()
    {
        $tankTrucks = TankTruck::where('distributor_id', auth()->id())
            ->pluck('id');

        $histories = TankTruckHistory::with('user')
            ->whereIn('tank_truck_id', $tankTrucks)
            ->where('aktivitas', 'Verifikasi Dokumen')
            ->where('metadata->status', 'rejected')
            ->latest()
            ->paginate(20);


        return view('pages.distributor.document.rejected', compact('histories'));
    }
}
