<x-dashboard-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 space-y-4 sm:space-y-0">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Jadwal Checklist Tangki</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Tanggal: <span
                        class="font-medium">{{ \Carbon\Carbon::parse($date)->translatedFormat('l, d F Y') }}</span>
                </p>
            </div>
            <div class="flex space-x-3">
                <x-dashboard.button href="{{ route('admin.checklist-schedule.index') }}" variant="secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Kembali
                </x-dashboard.button>
            </div>
        </div>

        <!-- Schedule Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($schedules as $schedule)
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden border border-gray-200 dark:border-gray-700 transition-all hover:shadow-lg dark:hover:border-gray-600">
                    <!-- Vehicle Header -->
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 dark:from-blue-700 dark:to-blue-800 p-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-white">
                                {{ $schedule->vehicle->plat_nomor }}
                            </h3>
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-200 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                {{ $schedule->vehicle->jenis_kendaraan }}
                            </span>
                        </div>
                        <p class="text-sm text-blue-100 dark:text-blue-200 mt-1">
                            {{ $schedule->vehicle->merk }} {{ $schedule->vehicle->tipe }}
                        </p>
                    </div>

                    <!-- Schedule Details -->
                    <div class="p-5">
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Waktu</p>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ \Carbon\Carbon::parse($schedule->waktu)->format('H:i') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Lokasi</p>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $schedule->lokasi }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Jenis Layanan</p>
                                <p class="text-sm font-medium text-gray-900 dark:text-white capitalize">
                                    {{ $schedule->jenis_layanan }}
                                </p>
                            </div>
                            {{-- <div>
                                <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Status</p>
                                <p class="text-sm font-medium">
                                    @if ($schedule->status == 'terjadwal')
                                        <span class="text-yellow-600 dark:text-yellow-400">Terjadwal</span>
                                    @elseif($schedule->status == 'dalam_proses')
                                        <span class="text-blue-600 dark:text-blue-400">Dalam Proses</span>
                                    @elseif($schedule->status == 'selesai')
                                        <span class="text-green-600 dark:text-green-400">Selesai</span>
                                    @else
                                        <span class="text-red-600 dark:text-red-400">Dibatalkan</span>
                                    @endif
                                </p>
                            </div> --}}
                        </div>

                        <!-- Checklist Results Section -->
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                            <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Hasil Checklist</h4>

                            @if ($schedule->checklistDocuments->count() > 0)
                                <div class="space-y-3">
                                    @foreach ($schedule->checklistDocuments as $result)
                                        <div class="flex items-start">
                                            <div
                                                class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300 mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $result->petugas->nama }}
                                                </p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $result->created_at->format('d M Y H:i') }}
                                                </p>
                                                <div class="mt-1">
                                                    <a href="{{ Storage::url($result->file_path) }}" target="_blank"
                                                        class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm inline-flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                        Lihat Dokumen
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-500 dark:text-gray-400 italic">Belum ada hasil checklist</p>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-6 flex space-x-3">
                            @if ($schedule->status != 'dibatalkan')
                                <x-dashboard.button
                                    href="{{ route('admin.checklist-schedule.document', [$schedule, $schedule->vehicle]) }}"
                                    variant="default" class="w-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    Upload Hasil
                                </x-dashboard.button>
                            @endif

                            {{-- <x-dashboard.button href="{{ route('admin.checklist-schedule.show', $schedule) }}"
                                variant="secondary" class="w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Detail
                            </x-dashboard.button> --}}
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 dark:text-gray-500"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-white">Tidak ada jadwal</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Tidak ada jadwal checklist untuk tanggal
                        ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-dashboard-layout>
