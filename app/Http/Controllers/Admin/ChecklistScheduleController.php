<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChecklistSchedule;
use App\Models\TankTruck;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ChecklistScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = ChecklistSchedule::with('vehicle')->get();

        $schedulesByDate = $schedules->groupBy(function ($date) {
            return Carbon::parse($date->tanggal)->format('Y-m-d');
        });

        $dateInfo = [];
        foreach ($schedulesByDate as $date => $schedulesOnDate) {
            $services = $schedulesOnDate->pluck('jenis_layanan')->unique()->values()->all();
            $dateInfo[$date] = [
                'services' => $services,
                'has_schedule' => true,
            ];
        }
        return view('pages.admin.checklist-schedule.index', [
            'schedules' => $schedules,
            'dateInfo' => json_encode($dateInfo),
        ]);
    }

    public function create()
    {
        $distributors = User::role('admin-distributor')->get();
        $vehicles = TankTruck::all();
        $jenisLayanan = [
            'checklist_harian' => 'Checklist Harian',
            'checklist_mingguan' => 'Checklist Mingguan',
            'rejected' => 'Rejected'
        ];

        return view('pages.admin.checklist-schedule.create', compact('distributors', 'vehicles', 'jenisLayanan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'lokasi' => 'required|string|max:255',
            'distributor_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:tank_trucks,id',
            'jenis_layanan' => 'required|in:checklist_harian,checklist_mingguan,rejected',
            'catatan' => 'nullable|string',
        ]);

        $validated['status'] = 'terjadwal';
        $validated['created_by'] = Auth::id();

        ChecklistSchedule::create($validated);

        return redirect()->route('admin.checklist-schedule.index')
            ->with('success', 'Jadwal checklist berhasil ditambahkan');
    }

    public function edit(ChecklistSchedule $checklistSchedule)
    {
        $distributors = User::role('admin-distributor')->get();
        $vehicles = TankTruck::all();
        $jenisLayanan = [
            'checklist_harian' => 'Checklist Harian',
            'checklist_mingguan' => 'Checklist Mingguan',
            'rejected' => 'Rejected'
        ];
        $statuses = [
            'terjadwal' => 'Terjadwal',
            'dalam_proses' => 'Dalam Proses',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan'
        ];

        return view('pages.admin.checklist-schedule.create', compact(
            'checklistSchedule',
            'distributors',
            'vehicles',
            'jenisLayanan',
            'statuses'
        ));
    }

    public function update(Request $request, ChecklistSchedule $checklistSchedule)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'lokasi' => 'required|string|max:255',
            'distributor_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:tank_trucks,id',
            'jenis_layanan' => 'required|in:checklist_harian,checklist_mingguan,rejected',
            'status' => 'required|in:terjadwal,dalam_proses,selesai,dibatalkan',
            'catatan' => 'nullable|string',
        ]);

        $checklistSchedule->update($validated);

        return redirect()->route('admin.checklist-schedule.index')
            ->with('success', 'Jadwal checklist berhasil diperbarui');
    }

    public function destroy(ChecklistSchedule $checklistSchedule)
    {
        $checklistSchedule->delete();

        return redirect()->route('admin.checklist-schedule.index')
            ->with('success', 'Jadwal checklist berhasil dihapus');
    }

    public function showByDate($date)
    {
        $schedules = ChecklistSchedule::with('vehicle')
            ->whereDate('tanggal', $date)
            ->get();

        return view('pages.admin.checklist-schedule.show-by-date', [
            'schedules' => $schedules,
            'date' => $date,
        ]);
    }
}
