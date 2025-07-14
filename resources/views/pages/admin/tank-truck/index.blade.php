<x-dashboard-layout>
    <div class="py-6">
        <x-dashboard.card>
            <x-dashboard.card.header>
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Manajemen Mobil Tangki</h2>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola data kendaraan tangki bahan bakar
                            Pertamina</p>
                    </div>
                    <div class="flex space-x-2">
                        <x-dashboard.button href="{{ route('admin.tank-trucks.create') }}" variant="default">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            Tambah Mobil Tangki
                        </x-dashboard.button>
                    </div>
                </div>
            </x-dashboard.card.header>

            <x-dashboard.card.content>
                <!-- Filter Form -->
                <form method="GET" action="{{ route('admin.tank-trucks.index') }}" class="mb-6">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <!-- Distributor Filter -->
                        <div>
                            <x-input-label for="distributor_id" value="Distributor" />
                            <select id="distributor_id" name="distributor_id"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="">Semua Distributor</option>
                                @foreach ($distributors as $distributor)
                                    <option value="{{ $distributor->id }}"
                                        {{ request('distributor_id') == $distributor->id ? 'selected' : '' }}>
                                        {{ $distributor->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Status Filter -->
                        <div>
                            <x-input-label for="status" value="Status Kendaraan" />
                            <select id="status" name="status"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="">Semua Status</option>
                                @foreach ($statuses as $key => $status)
                                    <option value="{{ $key }}"
                                        {{ request('status') == $key ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Search -->
                        <div>
                            <x-input-label for="search" value="Cari (Plat/Nomor Lambung/Merk/Tipe)" />
                            <div class="flex space-x-2">
                                <x-text-input id="search" name="search" type="text" class="block w-full"
                                    value="{{ request('search') }}" placeholder="Masukkan kata kunci..." />
                                <x-dashboard.button type="submit" variant="secondary">
                                    Filter
                                </x-dashboard.button>
                                <x-dashboard.button href="{{ route('admin.tank-trucks.index') }}" variant="secondary">
                                    Reset
                                </x-dashboard.button>
                            </div>
                        </div>
                    </div>
                </form>

                <x-alert />

                <div class="overflow-x-auto shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                    Plat Nomor
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                    Kendaraan
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                    Distributor
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                    Dokumen
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
                            @forelse ($tankTrucks as $truck)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-lg font-bold text-gray-900 dark:text-white">
                                            {{ $truck->plat_nomor }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            Lambung: {{ $truck->nomor_lambung }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $truck->merk }} {{ $truck->tipe }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $truck->jenis_kendaraan }} • {{ $truck->tahun_pembuatan }} •
                                            {{ $truck->kapasitas }} L
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 dark:text-white">
                                            {{ $truck->distributor->nama }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $truck->distributor->no_telephone }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-2">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                {{ $truck->approvedDocuments->count() }} Disetujui
                                            </span>
                                            @if ($truck->pendingDocuments->count() > 0)
                                                <span
                                                    class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                                    {{ $truck->pendingDocuments->count() }} Pending
                                                </span>
                                            @endif
                                            @if ($truck->rejectedDocuments->count() > 0)
                                                <span
                                                    class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                    {{ $truck->rejectedDocuments->count() }} Ditolak
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($truck->status == 'aktif')
                                            <span
                                                class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                Aktif
                                            </span>
                                        @elseif($truck->status == 'nonaktif')
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
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <x-dashboard.button href="{{ route('admin.tank-trucks.show', $truck) }}"
                                                variant="secondary" size="sm">
                                                Detail
                                            </x-dashboard.button>
                                            <x-dashboard.button href="{{ route('admin.tank-trucks.edit', $truck) }}"
                                                variant="secondary" size="sm">
                                                Edit
                                            </x-dashboard.button>
                                            <form action="{{ route('admin.tank-trucks.destroy', $truck) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mobil tangki ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <x-dashboard.button type="submit" variant="destructive" size="sm">
                                                    Hapus
                                                </x-dashboard.button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"
                                        class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                        Tidak ada data mobil tangki
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($tankTrucks->hasPages())
                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                        {{ $tankTrucks->links() }}
                    </div>
                @endif
            </x-dashboard.card.content>
        </x-dashboard.card>
    </div>
</x-dashboard-layout>
