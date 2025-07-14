<x-dashboard-layout>
    <div class="py-6">
        <x-alert />
        <div class="grid grid-cols-1 gap-6">

            <!-- Documents & History -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Documents -->
                <x-dashboard.card>
                    <x-dashboard.card.header>
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                                Dokumen Kendaraan {{ $tankTruck->plat_nomor }}</h2>
                            </h2>
                            <div class="flex space-x-2">
                                <x-dashboard.button href="{{ route('distributor.tank-trucks.document-form', $tankTruck) }}"
                                    variant="secondary" size="sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Upload Dokumen
                                </x-dashboard.button>
                            </div>
                        </div>
                    </x-dashboard.card.header>

                    <x-dashboard.card.content>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                            Jenis Dokumen
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                            Nomor
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                            Masa Berlaku
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
                                    @forelse ($documents as $document)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div
                                                    class="text-sm font-medium text-gray-900 dark:text-white uppercase">
                                                    {{ $document->jenis_dokumen }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 dark:text-white">
                                                    {{ $document->nomor_dokumen }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 dark:text-white">
                                                    {{ $document->tanggal_kadaluarsa->format('d M Y') }}
                                                </div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $document->tanggal_terbit->format('d M Y') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($document->status == 'approved')
                                                    <span
                                                        class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                        Disetujui
                                                    </span>
                                                @elseif($document->status == 'pending')
                                                    <span
                                                        class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                                        Menunggu Verifikasi
                                                    </span>
                                                @else
                                                    <span
                                                        class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                        Ditolak
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex justify-end space-x-2">
                                                    <a href="{{ Storage::url($document->file_path) }}" target="_blank"
                                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                        Lihat
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5"
                                                class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                                Tidak ada dokumen yang diupload
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </x-dashboard.card.content>
                </x-dashboard.card>
            </div>
        </div>
    </div>

</x-dashboard-layout>
