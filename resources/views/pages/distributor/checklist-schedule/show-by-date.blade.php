<x-dashboard-layout>
    <div class="p-4">
        <h2 class="text-lg font-bold mb-4">Jadwal untuk tanggal {{ $date }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($schedules as $schedule)
                <div class="bg-white shadow-md rounded-lg p-4">
                    <p class="font-bold">{{ $schedule->vehicle->plat_nomor }}</p>
                    <p>{{ $schedule->jenis_layanan }}</p>
                    <p class="text-gray-500">{{ \Carbon\Carbon::parse($schedule->waktu)->format('H:i') }}</p>
                </div>
            @endforeach
        </div>
    </div>
</x-dashboard-layout>
