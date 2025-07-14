<?php

namespace App\Http\Controllers\Distributor;

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
        return view('pages.distributor.checklist-schedule.index', [
            'schedules' => $schedules,
            'dateInfo' => json_encode($dateInfo),
        ]);
    }

    public function showByDate($date)
    {
        $schedules = ChecklistSchedule::with('vehicle')
            ->whereDate('tanggal', $date)
            ->get();

        return view('pages.distributor.checklist-schedule.show-by-date', [
            'schedules' => $schedules,
            'date' => $date,
        ]);
    }

    public function checklistForm(ChecklistSchedule $checklistSchedule, TankTruck $tankTruck)
    {
        $documents = $tankTruck->checklistDocuments()
            ->where('checklist_schedule_id', $checklistSchedule->id)
            ->latest()
            ->get();
        return view('pages.distributor.checklist-schedule.document', compact('tankTruck', 'checklistSchedule', 'documents'));
    }
}
