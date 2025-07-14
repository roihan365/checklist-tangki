<x-dashboard-layout>
    <div class="py-6">
        <x-alert />
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Vehicle Information -->
            <div class="lg:col-span-1">
                <x-dashboard.card>
                    <x-dashboard.card.header>
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                            Informasi Mobil Tangki
                        </h2>
                    </x-dashboard.card.header>

                    <x-dashboard.card.content class="space-y-4">
                        {{-- <div class="flex justify-center">
                            @php
                                $fotoMobilDocs = $documents->where('jenis_dokumen', 'foto mobil');
                            @endphp

                            @if ($fotoMobilDocs->isNotEmpty())
                                @foreach ($fotoMobilDocs as $document)
                                    <img src="{{ Storage::url($document->file_path) }}" alt="Foto Mobil"
                                        class="w-48 h-48 object-cover rounded-lg">
                                @endforeach
                            @else
                                <div
                                    class="w-48 h-48 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                    <span class="text-gray-500 dark:text-gray-400">Foto Kendaraan</span>
                                </div>
                            @endif
                        </div> --}}

                        <div>
                            <h3 class="text-xl font-bold text-center text-gray-900 dark:text-white">
                                {{ $tankTruck->plat_nomor }}
                            </h3>
                            <p class="text-sm text-center text-gray-500 dark:text-gray-400">
                                {{ $tankTruck->merk }} {{ $tankTruck->tipe }}
                            </p>
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Nomor Lambung</span>
                                <span
                                    class="font-medium text-gray-900 dark:text-white">{{ $tankTruck->nomor_lambung }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Jenis Kendaraan</span>
                                <span
                                    class="font-medium text-gray-900 dark:text-white">{{ $tankTruck->jenis_kendaraan }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Tahun Pembuatan</span>
                                <span
                                    class="font-medium text-gray-900 dark:text-white">{{ $tankTruck->tahun_pembuatan }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Warna</span>
                                <span class="font-medium text-gray-900 dark:text-white">{{ $tankTruck->warna }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Kapasitas</span>
                                <span
                                    class="font-medium text-gray-900 dark:text-white">{{ number_format($tankTruck->kapasitas) }}
                                    liter</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Nomor Rangka</span>
                                <span
                                    class="font-medium text-gray-900 dark:text-white">{{ $tankTruck->nomor_rangka }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Nomor Mesin</span>
                                <span
                                    class="font-medium text-gray-900 dark:text-white">{{ $tankTruck->nomor_mesin }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Distributor</span>
                                <span
                                    class="font-medium text-gray-900 dark:text-white">{{ $tankTruck->distributor->nama }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Status</span>
                                @if ($tankTruck->status == 'aktif')
                                    <span
                                        class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        Aktif
                                    </span>
                                @elseif($tankTruck->status == 'nonaktif')
                                    <span
                                        class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                        Nonaktif
                                    </span>
                                @else
                                    <span
                                        class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                        Dalam Perbaikan
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="pt-4 flex space-x-2">
                            <x-dashboard.button href="{{ route('admin.tank-trucks.edit', $tankTruck) }}"
                                variant="secondary" class="w-full">
                                Edit Data
                            </x-dashboard.button>
                        </div>
                    </x-dashboard.card.content>
                </x-dashboard.card>
            </div>

            <!-- Documents & History -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Documents -->
                <x-dashboard.card>
                    <x-dashboard.card.header>
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                                Dokumen Kendaraan
                            </h2>
                            <div class="flex space-x-2">
                                <x-dashboard.button href="{{ route('admin.tank-trucks.document-form', $tankTruck) }}"
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
                                                    @if ($document->status == 'pending')
                                                        <button x-data="{}"
                                                            @click="$dispatch('open-modal', {id: 'review-document-{{ $document->id }}'})"
                                                            class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300">
                                                            Verifikasi
                                                        </button>
                                                    @endif
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

                <!-- History -->
                <x-dashboard.card>
                    <x-dashboard.card.header>
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                            Histori Aktivitas
                        </h2>
                    </x-dashboard.card.header>

                    <x-dashboard.card.content>
                        <div class="space-y-4">
                            @forelse ($histories as $history)
                                <div class="flex">
                                    <div class="flex-shrink-0 mr-3">
                                        <div
                                            class="flex items-center justify-center h-8 w-8 rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 border-b border-gray-200 dark:border-gray-700 pb-4">
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $history->aktivitas }}
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $history->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                        <p class="text-sm text-gray-600 dark:text-gray-300">
                                            {{ $history->deskripsi }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            Oleh: {{ $history->user->nama }}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-4">
                                    Tidak ada riwayat aktivitas
                                </p>
                            @endforelse
                        </div>

                        @if ($histories->hasPages())
                            <div
                                class="px-6 py-4 bg-gray-50 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                                {{ $histories->links() }}
                            </div>
                        @endif
                    </x-dashboard.card.content>
                </x-dashboard.card>
            </div>
        </div>
    </div>

    <!-- Document Review Modal -->
    @foreach ($documents as $document)
        @if ($document->status == 'pending')
            <x-modal id="review-document-{{ $document->id }}" title="Verifikasi Dokumen">
                <form method="POST" action="{{ route('admin.tank-trucks.document-review', $document) }}">
                    @csrf
                    <div x-data="{ status: 'approved' }" class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                Jenis Dokumen: <span
                                    class="font-medium uppercase">{{ $document->jenis_dokumen }}</span>
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                Nomor Dokumen: <span class="font-medium">{{ $document->nomor_dokumen }}</span>
                            </p>
                        </div>

                        <div>
                            <x-input-label :for="'status-' . $document->id" value="Status Verifikasi" />
                            <select :id="'status-' + {{ $document->id }}" name="status" x-model="status"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                required>
                                <option value="approved">Setujui</option>
                                <option value="rejected">Tolak</option>
                            </select>
                        </div>

                        <div x-show="status === 'rejected'" class="mt-4">
                            <x-input-label :for="'catatan-' . $document->id" value="Catatan Penolakan" />
                            <textarea :id="'catatan-' + {{ $document->id }}" name="catatan" rows="3"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"></textarea>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <x-dashboard.button type="button"
                            @click="$dispatch('close-modal', {id: 'review-document-{{ $document->id }}'})"
                            variant="secondary">
                            Batal
                        </x-dashboard.button>
                        <x-dashboard.button type="submit" variant="default">
                            Simpan
                        </x-dashboard.button>
                    </div>
                </form>
            </x-modal>
        @endif
    @endforeach

</x-dashboard-layout>
