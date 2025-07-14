<x-dashboard-layout>
    <div class="py-6">
        <x-dashboard.card>
            <x-dashboard.card.header>
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                            {{ isset($tankTruck) ? 'Edit Data Mobil Tangki' : 'Tambah Mobil Tangki Baru' }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            {{ isset($tankTruck) ? 'Perbarui data kendaraan tangki' : 'Tambahkan kendaraan tangki baru ke sistem' }}
                        </p>
                    </div>
                </div>
            </x-dashboard.card.header>

            <x-dashboard.card.content>
                <form method="POST"
                    action="{{ isset($tankTruck) ? route('distributor.tank-trucks.update', $tankTruck) : route('distributor.tank-trucks.store') }}">
                    @csrf
                    @if (isset($tankTruck))
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Plate Number & Hull Number -->
                        <div>
                            <x-input-label for="plat_nomor" value="Plat Nomor" />
                            <x-text-input id="plat_nomor" name="plat_nomor" type="text" class="block w-full uppercase"
                                value="{{ old('plat_nomor', $tankTruck->plat_nomor ?? '') }}" required />
                            @error('plat_nomor')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>

                        <div>
                            <x-input-label for="nomor_lambung" value="Nomor Lambung" />
                            <x-text-input id="nomor_lambung" name="nomor_lambung" type="text" class="block w-full"
                                value="{{ old('nomor_lambung', $tankTruck->nomor_lambung ?? '') }}" required />
                            @error('nomor_lambung')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 mt-4 md:grid-cols-3">
                        <!-- Vehicle Details -->
                        <div>
                            <x-input-label for="jenis_kendaraan" value="Jenis Kendaraan" />
                            <x-text-input id="jenis_kendaraan" name="jenis_kendaraan" type="text"
                                class="block w-full"
                                value="{{ old('jenis_kendaraan', $tankTruck->jenis_kendaraan ?? '') }}" required />
                            @error('jenis_kendaraan')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>

                        <div>
                            <x-input-label for="merk" value="Merk" />
                            <x-text-input id="merk" name="merk" type="text" class="block w-full"
                                value="{{ old('merk', $tankTruck->merk ?? '') }}" required />
                            @error('merk')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>

                        <div>
                            <x-input-label for="tipe" value="Tipe" />
                            <x-text-input id="tipe" name="tipe" type="text" class="block w-full"
                                value="{{ old('tipe', $tankTruck->tipe ?? '') }}" required />
                            @error('tipe')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 mt-4 md:grid-cols-3">
                        <!-- Additional Details -->
                        <div>
                            <x-input-label for="tahun_pembuatan" value="Tahun Pembuatan" />
                            <x-text-input id="tahun_pembuatan" name="tahun_pembuatan" type="number"
                                class="block w-full"
                                value="{{ old('tahun_pembuatan', $tankTruck->tahun_pembuatan ?? '') }}" min="1990"
                                max="{{ date('Y') + 1 }}" required />
                            @error('tahun_pembuatan')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>

                        <div>
                            <x-input-label for="warna" value="Warna" />
                            <x-text-input id="warna" name="warna" type="text" class="block w-full"
                                value="{{ old('warna', $tankTruck->warna ?? '') }}" required />
                            @error('warna')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>

                        <div>
                            <x-input-label for="kapasitas" value="Kapasitas (liter)" />
                            <x-text-input id="kapasitas" name="kapasitas" type="number" step="0.01"
                                class="block w-full" value="{{ old('kapasitas', $tankTruck->kapasitas ?? '') }}"
                                min="1000" required />
                            @error('kapasitas')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 mt-4 md:grid-cols-2">
                        <!-- Identification Numbers -->
                        <div>
                            <x-input-label for="nomor_rangka" value="Nomor Rangka" />
                            <x-text-input id="nomor_rangka" name="nomor_rangka" type="text" class="block w-full"
                                value="{{ old('nomor_rangka', $tankTruck->nomor_rangka ?? '') }}" required />
                            @error('nomor_rangka')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>

                        <div>
                            <x-input-label for="nomor_mesin" value="Nomor Mesin" />
                            <x-text-input id="nomor_mesin" name="nomor_mesin" type="text" class="block w-full"
                                value="{{ old('nomor_mesin', $tankTruck->nomor_mesin ?? '') }}" required />
                            @error('nomor_mesin')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 mt-4 md:grid-cols-2">
                        <!-- Distributor & Status -->
                        <div>
                            <x-input-label for="distributor_id" value="Distributor" />
                            <select id="distributor_id" name="distributor_id"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                required>
                                <option value="">Pilih Distributor</option>
                                @foreach ($distributors as $distributor)
                                    <option value="{{ $distributor->id }}"
                                        {{ old('distributor_id', $tankTruck->distributor_id ?? '') == $distributor->id ? 'selected' : '' }}>
                                        {{ $distributor->nama }} ({{ $distributor->no_telephone }})
                                    </option>
                                @endforeach
                            </select>
                            @error('distributor_id')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>

                        <div>
                            <x-input-label for="status" value="Status Kendaraan" />
                            <select id="status" name="status"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                required>
                                <option value="aktif"
                                    {{ old('status', $tankTruck->status ?? '') == 'aktif' ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="nonaktif"
                                    {{ old('status', $tankTruck->status ?? '') == 'nonaktif' ? 'selected' : '' }}>
                                    Nonaktif</option>
                                <option value="dalam_perbaikan"
                                    {{ old('status', $tankTruck->status ?? '') == 'dalam_perbaikan' ? 'selected' : '' }}>
                                    Dalam Perbaikan</option>
                            </select>
                            @error('status')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 mt-4 md:grid-cols-2">
                        <!-- Active Dates -->
                        <div>
                            <x-input-label for="tanggal_aktif" value="Tanggal Aktif" />
                            <x-text-input id="tanggal_aktif" name="tanggal_aktif" type="date"
                                class="block w-full"
                                value="{{ old('tanggal_aktif', isset($tankTruck) && $tankTruck->tanggal_aktif ? $tankTruck->tanggal_aktif->format('Y-m-d') : '') }}" />
                            @error('tanggal_aktif')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>

                        <div>
                            <x-input-label for="tanggal_nonaktif" value="Tanggal Nonaktif" />
                            <x-text-input id="tanggal_nonaktif" name="tanggal_nonaktif" type="date"
                                class="block w-full"
                                value="{{ old('tanggal_nonaktif', isset($tankTruck) && $tankTruck->tanggal_nonaktif ? $tankTruck->tanggal_nonaktif->format('Y-m-d') : '') }}" />
                            @error('tanggal_nonaktif')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="keterangan" value="Keterangan (Opsional)" />
                        <textarea id="keterangan" name="keterangan" rows="3"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">{{ old('keterangan', $tankTruck->keterangan ?? '') }}</textarea>
                        @error('keterangan')
                            <x-input-error>{{ $message }}</x-input-error>
                        @enderror
                    </div>

                    <div class="flex justify-end mt-6 space-x-3">
                        <x-dashboard.button href="{{ route('distributor.tank-trucks.index') }}" variant="secondary">
                            Batal
                        </x-dashboard.button>
                        <x-dashboard.button type="submit" variant="default">
                            {{ isset($tankTruck) ? 'Update' : 'Simpan' }}
                        </x-dashboard.button>
                    </div>
                </form>
            </x-dashboard.card.content>
        </x-dashboard.card>
    </div>
</x-dashboard-layout>
