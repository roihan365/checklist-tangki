<table>
    <thead>
        <tr>
            <th colspan="6">Laporan Checklist {{ $reportType }} Truk Tangki</th>
        </tr>
        <tr>
            <th colspan="6">Periode: {{ $startDate->format('d/m/Y') }} -
                {{ $endDate->format('d/m/Y') }}</th>
        </tr>
        <tr>
            <th>Tanggal</th>
            <th>Kendaraan</th>
            <th>Distributor</th>
            <th>Lokasi</th>
            <th>Status</th>
            <th>Catatan</th>
            @if ($includeDetails)
                <th>Detail Checklist</th>
            @endif
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
                @if ($includeDetails)
                    <td>
                        @foreach ($schedule->checklistDocuments as $doc)
                            <strong>{{ $doc->nama_dokumen }}</strong> ({{ $doc->status }})<br>
                            @foreach ($doc->checklistItems as $item)
                                &nbsp;&nbsp;- {{ $item->nama_item }}: {{ $item->status }}<br>
                            @endforeach
                        @endforeach
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
