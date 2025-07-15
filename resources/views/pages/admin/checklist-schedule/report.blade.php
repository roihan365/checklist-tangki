<x-dashboard-layout>
    <div class="py-6">
        <x-dashboard.card>
            <x-dashboard.card.header>
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Laporan Checklist</h2>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Buat laporan checklist untuk truk tangki
                        </p>
                    </div>
                </div>
                <x-alert />
            </x-dashboard.card.header>
            <x-dashboard.card.content>
                <form action="{{ route('admin.report.checklist-schedule.generate') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                        <div>
                            <label for="report_type"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipe Laporan</label>
                            <select id="report_type" name="report_type"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option>Pilih Tipe Laporan</option>
                                <option value="harian">Harian</option>
                                <option value="mingguan">Mingguan</option>
                                <option value="bulanan">Bulanan</option>
                            </select>
                        </div>
                        <div>
                            <label for="report_format"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Format
                                Laporan</label>
                            <select id="report_format" name="report_format"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="pdf">PDF</option>
                                <option value="excel">Excel</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                        <div>
                            <label for="start_date"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dari Tanggal</label>
                            <input type="date" id="start_date" name="start_date"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>
                        <div>
                            <label for="end_date"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sampai
                                Tanggal</label>
                            <input type="date" id="end_date" name="end_date"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">Opsi Tambahan</h3>
                        <div class="mt-2 space-y-2">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="include_details" name="include_details" type="checkbox"
                                        class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="include_details"
                                        class="font-medium text-gray-700 dark:text-gray-300">Sertakan detail
                                        checklist</label>
                                </div>
                            </div>
                            {{-- <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="only_rejected" name="only_rejected" type="checkbox"
                                        class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="only_rejected"
                                        class="font-medium text-gray-700 dark:text-gray-300">Hanya yang rejected</label>
                                </div>
                            </div> --}}
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="group_by_vehicle" name="group_by_vehicle" type="checkbox"
                                        class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="group_by_vehicle"
                                        class="font-medium text-gray-700 dark:text-gray-300">Kelompokkan berdasarkan
                                        kendaraan</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <x-dashboard.button type="reset" variant="secondary">Reset</x-dashboard.button>
                        <x-dashboard.button type="submit" variant="default">Buat Laporan</x-dashboard.button>
                    </div>
                </form>
            </x-dashboard.card.content>
        </x-dashboard.card>
    </div>

    <div class="py-6">
        <x-dashboard.card>
            <x-dashboard.card.header>
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Laporan Checklist</h2>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Lihat riwayat laporan yang telah
                            dibuat</p>
                    </div>
                </div>
                <x-alert />
            </x-dashboard.card.header>
            <x-dashboard.card.content>
                <div class="overflow-x-auto shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                    Nama Laporan
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                    Periode
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                    Dibuat Oleh
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                    Status
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @forelse ($checklistReports as $report)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-white">
                                            {{ $report->report_name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            @if (isset($report->parameters['start_date']) && isset($report->parameters['end_date']))
                                                {{ \Carbon\Carbon::parse($report->parameters['start_date'])->format('d M Y') }}
                                                -
                                                {{ \Carbon\Carbon::parse($report->parameters['end_date'])->format('d M Y') }}
                                            @else
                                                N/A
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-white">
                                            {{ $report->user->nama ?? 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusClass =
                                                [
                                                    'completed' =>
                                                        'bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-100',
                                                    'processing' =>
                                                        'bg-yellow-100 text-yellow-800 dark:bg-yellow-700 dark:text-yellow-100',
                                                    'failed' =>
                                                        'bg-red-100 text-red-800 dark:bg-red-700 dark:text-red-100',
                                                ][$report->status] ??
                                                'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-100';
                                        @endphp
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                            {{ ucfirst($report->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @if ($report->status === 'completed')
                                            <form action="{{ route('admin.report.checklist-schedule.generate') }}"
                                                method="post">
                                                @csrf

                                                <select hidden id="report_type" name="report_type"
                                                    class="mt-1 hidden w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                    <option value="harian"
                                                        {{ $report->parameters['report_type'] === 'harian' ? 'selected' : '' }}>
                                                        Harian</option>
                                                    <option value="mingguan"
                                                        {{ $report->parameters['report_type'] === 'mingguan' ? 'selected' : '' }}>
                                                        Mingguan</option>
                                                    <option value="bulanan"
                                                        {{ $report->parameters['report_type'] === 'bulanan' ? 'selected' : '' }}>
                                                        Bulanan</option>
                                                </select>

                                                <select hidden id="report_format" name="report_format"
                                                    class="mt-1 hidden w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                    <option value="pdf"
                                                        {{ $report->parameters['report_format'] === 'pdf' ? 'selected' : '' }}>PDF
                                                    </option>
                                                    <option value="excel"
                                                        {{ $report->parameters['report_format'] === 'excel' ? 'selected' : '' }}>
                                                        Excel</option>
                                                </select>

                                                <input hidden type="date" id="start_date" name="start_date"
                                                    value="{{ $report->parameters['start_date'] ?? '' }}"
                                                    class="mt-1 hidden focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                <input hidden type="date" id="end_date" name="end_date"
                                                    value="{{ $report->parameters['end_date'] ?? '' }}"
                                                    class="mt-1 hidden focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                <input hidden id="include_details" name="include_details"
                                                    type="checkbox"
                                                    {{ $report->parameters['include_details'] ? 'checked' : '' }}
                                                    class="hidden focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600">
                                                <input hidden id="group_by_vehicle" name="group_by_vehicle"
                                                    type="checkbox"
                                                    {{ $report->parameters['group_by_vehicle'] ? 'checked' : '' }}
                                                    class="hidden focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600">

                                                <x-dashboard.button variants="default" type="submit"
                                                    class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600">Unduh</x-dashboard.button>
                                            </form>
                                        @else
                                            <span class="text-gray-400 dark:text-gray-500">Tidak Tersedia</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"
                                        class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500 dark:text-gray-400">
                                        Tidak ada laporan yang tersedia.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination Links --}}
                <div class="mt-4">
                    {{ $checklistReports->links() }}
                </div>
            </x-dashboard.card.content>
        </x-dashboard.card>
    </div>
</x-dashboard-layout>
