<!DOCTYPE html>
<html>

<head>
    <title>Laporan Checklist Truk Tangki</title>
    <style>
        body {
            font-family: sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
        }

        .info {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .group-header {
            background-color: #e2e2e2;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Laporan Checklist {{ $reportType }} Truk Tangki</h1>
        <p>Periode: {{ $startDate->format('d/m/Y') }} - {{ $endDate->format('d/m/Y') }}</p>
    </div>

    @if ($groupByVehicle)
        @foreach ($schedules as $vehicleId => $vehicleSchedules)
            <div class="info">
                <h3>Kendaraan: {{ $vehicleSchedules->first()->vehicle->plat_nomor ?? 'N/A' }}</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Distributor</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehicleSchedules as $schedule)
                        <tr>
                            <td>{{ $schedule->tanggal->format('d/m/Y') }}</td>
                            <td>{{ $schedule->distributor->name ?? 'N/A' }}</td>
                            <td>{{ $schedule->lokasi }}</td>
                            <td>{{ $schedule->status }}</td>
                            <td>{{ $schedule->catatan }}</td>
                        </tr>
                        @if ($includeDetails && $schedule->checklistDocuments->isNotEmpty())
                            <tr>
                                <td colspan="5">
                                    <strong>Detail Checklist:</strong>
                                    <ul>
                                        @foreach ($schedule->checklistDocuments as $doc)
                                            <li><strong>Dokumen:</strong> {{ $doc->nama_dokumen }} - Status:
                                                {{ $doc->status }}</li>
                                            @if ($doc->checklistItems->isNotEmpty())
                                                <ul style="list-style-type: none;">
                                                    @foreach ($doc->checklistItems as $item)
                                                        <li>- {{ $item->nama_item }} : {{ $item->status }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <br>
        @endforeach
    @else
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Kendaraan</th>
                    <th>Distributor</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schedules as $schedule)
                    <tr>
                        <td>{{ $schedule->tanggal->format('d/m/Y') }}</td>
                        <td>{{ $schedule->vehicle->plat_nomor ?? 'N/A' }}</td>
                        <td>{{ $schedule->distributor->name ?? 'N/A' }}</td>
                        <td>{{ $schedule->lokasi }}</td>
                        <td>{{ $schedule->status }}</td>
                        <td>{{ $schedule->catatan }}</td>
                    </tr>
                    @if ($includeDetails && $schedule->checklistDocuments->isNotEmpty())
                        <tr>
                            <td colspan="6">
                                <strong>Detail Checklist:</strong>
                                <ul>
                                    @foreach ($schedule->checklistDocuments as $doc)
                                        <li><strong>Dokumen:</strong> {{ $doc->file_path }} - Status:
                                            {{ $doc->status }}</li>
                                        {{-- @if ($doc->checklistItems->isNotEmpty())
                                            <ul style="list-style-type: none;">
                                                @foreach ($doc->checklistItems as $item)
                                                    <li>- {{ $item->nama_item }} : {{ $item->status }}</li>
                                                @endforeach
                                            </ul>
                                        @endif --}}
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @endif
</body>

</html>
