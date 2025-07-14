<x-dashboard-layout>
    <div class="py-6">
        <x-dashboard.card>
            <x-dashboard.card.header>
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                            {{ isset($schedule) ? 'Edit Jadwal Checklist' : 'Buat Jadwal Checklist Baru' }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            {{ isset($schedule) ? 'Perbarui jadwal pemeriksaan kendaraan tangki' : 'Tambahkan jadwal pemeriksaan baru untuk kendaraan tangki' }}
                        </p>
                    </div>
                </div>
            </x-dashboard.card.header>

            <x-dashboard.card.content>
                <form method="POST"
                    action="{{ isset($schedule) ? route('admin.checklist-schedule.update', $schedule) : route('admin.checklist-schedule.store') }}">
                    @csrf
                    @if (isset($schedule))
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Date & Time -->
                        <div>
                            <x-input-label for="tanggal" value="Tanggal Pemeriksaan" />
                            <x-text-input id="tanggal" name="tanggal" type="date" class="block w-full"
                                value="{{ old('tanggal', isset($schedule) ? $schedule->tanggal->format('Y-m-d') : '') }}"
                                required />
                            @error('tanggal')
                                <x-input-error messages="$message"></x-input-error>
                            @enderror
                        </div>

                        <div>
                            <x-input-label for="waktu" value="Waktu Pemeriksaan" />
                            <x-text-input id="waktu" name="waktu" type="time" class="block w-full"
                                value="{{ old('waktu', $schedule->waktu ?? '') }}" required />
                            @error('waktu')
                                <x-input-error messages="$message"></x-input-error>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="lokasi" value="Lokasi Pemeriksaan" />
                        <x-text-input id="lokasi" name="lokasi" type="text" class="block w-full"
                            value="{{ old('lokasi', $schedule->lokasi ?? '') }}" required />
                        @error('lokasi')
                            <x-input-error messages="$message"></x-input-error>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 gap-6 mt-4 md:grid-cols-2">
                        <!-- Distributor -->
                        <div>
                            <x-input-label for="distributor_id" value="Distributor" />
                            <select id="distributor_id" name="distributor_id"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                required>
                                <option value="">Pilih Distributor</option>
                                @foreach ($distributors as $distributor)
                                    <option value="{{ $distributor->id }}"
                                        {{ old('distributor_id', $schedule->distributor_id ?? '') == $distributor->id ? 'selected' : '' }}>
                                        {{ $distributor->nama }} ({{ $distributor->no_telephone }})
                                    </option>
                                @endforeach
                            </select>
                            @error('distributor_id')
                                <x-input-error messages="$message"></x-input-error>
                            @enderror
                        </div>

                        <!-- Vehicle -->
                        <div>
                            <x-input-label for="vehicle_id" value="Kendaraan Tangki" />
                            <select id="vehicle_id" name="vehicle_id"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                required>
                                <option value="">Pilih Kendaraan</option>
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}"
                                        {{ old('vehicle_id', $schedule->vehicle_id ?? '') == $vehicle->id ? 'selected' : '' }}>
                                        {{ $vehicle->plat_nomor }} ({{ $vehicle->jenis_kendaraan }})
                                    </option>
                                @endforeach
                            </select>
                            @error('vehicle_id')
                                <x-input-error messages="$message"></x-input-error>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 mt-4 md:grid-cols-2">
                        <!-- Service Type -->
                        <div>
                            <x-input-label for="jenis_layanan" value="Jenis Layanan" />
                            <select id="jenis_layanan" name="jenis_layanan"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                required>
                                @foreach ($jenisLayanan as $key => $layanan)
                                    <option value="{{ $key }}"
                                        {{ old('jenis_layanan', $schedule->jenis_layanan ?? '') == $key ? 'selected' : '' }}>
                                        {{ $layanan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jenis_layanan')
                                <x-input-error messages="$message"></x-input-error>
                            @enderror
                        </div>

                        <!-- Status (only in edit) -->
                        @if (isset($schedule))
                            <div>
                                <x-input-label for="status" value="Status" />
                                <select id="status" name="status"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                    required>
                                    @foreach ($statuses as $key => $status)
                                        <option value="{{ $key }}"
                                            {{ old('status', $schedule->status ?? '') == $key ? 'selected' : '' }}>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <x-input-error messages="$message"></x-input-error>
                                @enderror
                            </div>
                        @endif
                    </div>

                    <div class="mt-4">
                        <x-input-label for="catatan" value="Catatan (Opsional)" />
                        <textarea id="catatan" name="catatan" rows="3"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">{{ old('catatan', $schedule->catatan ?? '') }}</textarea>
                        @error('catatan')
                            <x-input-error messages="$message"></x-input-error>
                        @enderror
                    </div>

                    <div class="flex justify-end mt-6 space-x-3">
                        <x-dashboard.button href="{{ route('admin.checklist-schedule.index') }}" variant="secondary">
                            Batal
                        </x-dashboard.button>
                        <x-dashboard.button type="submit" variant="default">
                            {{ isset($schedule) ? 'Update' : 'Simpan' }}
                        </x-dashboard.button>
                    </div>
                </form>
            </x-dashboard.card.content>
        </x-dashboard.card>
    </div>

    @push('scripts')
        <script>
            // Dynamic vehicle selection based on distributor
            document.getElementById('distributor_id').addEventListener('change', function() {
                const distributorId = this.value;
                const vehicleSelect = document.getElementById('vehicle_id');

                if (distributorId) {
                    fetch(`/api/distributors/${distributorId}/vehicles`)
                        .then(response => response.json())
                        .then(data => {
                            vehicleSelect.innerHTML = '<option value="">Pilih Kendaraan</option>';
                            data.forEach(vehicle => {
                                const option = document.createElement('option');
                                option.value = vehicle.id;
                                option.textContent = `${vehicle.plat_nomor} (${vehicle.jenis_kendaraan})`;
                                vehicleSelect.appendChild(option);
                            });
                        });
                } else {
                    vehicleSelect.innerHTML = '<option value="">Pilih Kendaraan</option>';
                    @foreach ($vehicles as $vehicle)
                        const option = document.createElement('option');
                        option.value = "{{ $vehicle->id }}";
                        option.textContent = "{{ $vehicle->plat_nomor }} ({{ $vehicle->jenis_kendaraan }})";
                        vehicleSelect.appendChild(option);
                    @endforeach
                }
            });
        </script>
    @endpush
</x-dashboard-layout>
