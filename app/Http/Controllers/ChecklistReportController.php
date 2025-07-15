<?php

namespace App\Http\Controllers;

use App\Exports\ChecklistExport;
use App\Models\ChecklistReport;
use App\Models\ChecklistSchedule;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ChecklistReportController extends Controller
{
    public function index()
    {
        $checklistReports = ChecklistReport::orderBy('created_at', 'desc')
            ->paginate(10);
        return view('pages.admin.checklist-schedule.report', compact('checklistReports'));
    }

    public function generate(Request $request)
    {
        
        $request->validate([
            'report_type' => 'required|string|in:harian,bulanan,mingguan',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'report_format' => 'required|string|in:pdf,excel',
            'include_details' => 'nullable|in:on,off',
        ]);

        $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
        $endDate = Carbon::parse($request->input('end_date'))->endOfDay();
        $includeDetails = $request->input('include_details') === 'on' ? true : false;
        $onlyRejected = $request->has('only_rejected');
        $groupByVehicle = $request->has('group_by_vehicle');
        $reportFormat = $request->input('report_format');

        $query = ChecklistSchedule::with(['vehicle', 'distributor', 'checklistDocuments.checklistItems']);

        // Filter berdasarkan tanggal
        $query->whereBetween('tanggal', [$startDate, $endDate]);
        $query->where('jenis_layanan', 'checklist_' . $request->input('report_type'));

        // Filter untuk "Hanya yang rejected"
        // if ($onlyRejected) {
        //     $query->where('status', 'rejected');
        // }

        $schedules = $query->get();

        // Jika request "Kelompokkan berdasarkan kendaraan"
        if ($groupByVehicle) {
            $schedules = $schedules->groupBy('vehicle_id');
        }

        $data = [
            'reportType' => $request->input('report_type'),
            'schedules' => $schedules,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'includeDetails' => $includeDetails,
            'groupByVehicle' => $groupByVehicle
        ];

        // Simpan laporan ke database
        $report = ChecklistReport::create([
            'report_name' => 'Laporan Checklist ' . $request->input('report_type'),
            'parameters' => [
                'report_type' => $request->input('report_type'),
                'start_date' => $startDate->toDateString(),
                'end_date' => $endDate->toDateString(),
                'group_by_vehicle' => $groupByVehicle,
                'report_format' => $reportFormat,
                'include_details' => $includeDetails,
                'group_by_vehicle' => $groupByVehicle,
            ],
            // 'file_path' => null, // File path will be set after generating the report
            'user_id' => auth()->id(),
            'status' => 'completed',
        ]);

        if ($reportFormat == 'pdf') {
            return $this->generatePdf($data);
        }

        if ($reportFormat == 'excel') {
            return $this->generateExcel($data);
        }
    }

    private function generatePdf($data)
    {
        $pdf = Pdf::loadView('reports.templates.checklist-pdf', $data);
        return $pdf->download('laporan-checklist-' . $data['startDate']->format('Ymd') . '-' . $data['endDate']->format('Ymd') . '.pdf');
    }

    private function generateExcel($data)
    {
        return Excel::download(new ChecklistExport($data), 'laporan-checklist-' . $data['startDate']->format('Ymd') . '-' . $data['endDate']->format('Ymd') . '.xlsx');
    }
}
