<x-dashboard-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <x-dashboard.card>
            <x-dashboard.card.header class="flex flex-row items-center justify-between pb-2">
                <x-dashboard.card.title class="text-sm font-medium">
                    Admin Distributor
                </x-dashboard.card.title>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
            </x-dashboard.card.header>

            <x-dashboard.card.content>
                <div class="text-2xl font-bold">{{ $adminDistributors->count() }}</div>
                <x-dashboard.card.description>
                    Jumlah admin distributor
                </x-dashboard.card.description>
            </x-dashboard.card.content>
        </x-dashboard.card>
        
        <x-dashboard.card>
            <x-dashboard.card.header class="flex flex-row items-center justify-between pb-2">
                <x-dashboard.card.title class="text-sm font-medium">
                    Aktif
                </x-dashboard.card.title>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6 text-green-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </x-dashboard.card.header>

            <x-dashboard.card.content>
                <div class="text-2xl font-bold">{{ $adminDistributors->where('status_registrasi', 'approved')->count() }}</div>
                <x-dashboard.card.description>
                    Admin aktif
                </x-dashboard.card.description>
            </x-dashboard.card.content>
        </x-dashboard.card>
        
        <x-dashboard.card>
            <x-dashboard.card.header class="flex flex-row items-center justify-between pb-2">
                <x-dashboard.card.title class="text-sm font-medium">
                    Pending
                </x-dashboard.card.title>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6 text-yellow-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </x-dashboard.card.header>

            <x-dashboard.card.content>
                <div class="text-2xl font-bold">{{ $adminDistributors->where('status_registrasi', 'pending')->count() }}</div>
                <x-dashboard.card.description>
                    Menunggu verifikasi
                </x-dashboard.card.description>
            </x-dashboard.card.content>
        </x-dashboard.card>
        
        <x-dashboard.card>
            <x-dashboard.card.header class="flex flex-row items-center justify-between pb-2">
                <x-dashboard.card.title class="text-sm font-medium">
                    Ditolak
                </x-dashboard.card.title>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6 text-red-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </x-dashboard.card.header>

            <x-dashboard.card.content>
                <div class="text-2xl font-bold">{{ $adminDistributors->where('status_registrasi', 'rejected')->count() }}</div>
                <x-dashboard.card.description>
                    Registrasi ditolak
                </x-dashboard.card.description>
            </x-dashboard.card.content>
        </x-dashboard.card>
    </div>

    <div class="py-6">
        <x-dashboard.card>
            <x-dashboard.card.header>
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Manajemen Admin Distributor</h2>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola data admin distributor Pertamina</p>
                    </div>
                    <div class="flex space-x-2">
                        <x-dashboard.button href="{{ route('admin.distributor.create') }}" variant="default">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Tambah Admin
                        </x-dashboard.button>
                    </div>
                </div>
            </x-dashboard.card.header>

            <x-dashboard.card.content>
                <x-alert />
                <div class="overflow-x-auto shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                    Nama
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                    Kontak
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @forelse ($adminDistributors as $distributor)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="{{ $distributor->photo ? $distributor->photo : asset('images/default-profile.png') }}" alt="{{ $distributor->nama }}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $distributor->nama }}
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $distributor->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">{{ $distributor->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">{{ $distributor->no_telephone }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $distributor->alamat }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($distributor->status_registrasi == 'Berhasil')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            Aktif
                                        </span>
                                    @elseif($distributor->status_registrasi == 'Non-Berhasil')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                            Pending
                                        </span>
                                    {{-- @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                            Ditolak
                                        </span> --}}
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <x-dashboard.button href="{{ route('admin.distributor.edit', $distributor) }}" variant="secondary" size="sm">
                                            Edit
                                        </x-dashboard.button>
                                        <form action="{{ route('admin.distributor.destroy', $distributor) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin distributor ini?')">
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
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                    Tidak ada data admin distributor
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if ($adminDistributors->hasPages())
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                    {{ $adminDistributors->links() }}
                </div>
                @endif
            </x-dashboard.card.content>
        </x-dashboard.card>
    </div>
</x-dashboard-layout>