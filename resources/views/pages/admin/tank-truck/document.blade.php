<x-dashboard-layout>
    <div class="py-6">
        <x-dashboard.card>
            <x-dashboard.card.header>
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Upload Dokumen Mobil Tangki</h2>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Unggah dokumen kendaraan tangki
                            {{ $tankTruck->plat_nomor }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <x-dashboard.button href="{{ route('admin.tank-trucks.show', $tankTruck) }}" variant="secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            Kembali
                        </x-dashboard.button>
                    </div>
                </div>
            </x-dashboard.card.header>

            <x-dashboard.card.content>
                <form method="POST" action="{{ route('admin.tank-trucks.store-document', $tankTruck) }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Document Type -->
                        <div>
                            <x-input-label for="jenis_dokumen" value="Jenis Dokumen" required />
                            <select id="jenis_dokumen" name="jenis_dokumen"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                required>
                                <option value="">Pilih Jenis Dokumen</option>
                                <option value="stnk" {{ old('jenis_dokumen') == 'stnk' ? 'selected' : '' }}>STNK
                                </option>
                                <option value="kir" {{ old('jenis_dokumen') == 'kir' ? 'selected' : '' }}>KIR
                                </option>
                                <option value="tera" {{ old('jenis_dokumen') == 'tera' ? 'selected' : '' }}>
                                    TERA</option>
                                <option value="foto mobil" {{ old('jenis_dokumen') == 'foto mobil' ? 'selected' : '' }}>Foto Mobil</option>
                                <option value="other" {{ old('jenis_dokumen') == 'other' ? 'selected' : '' }}>Lainnya
                                </option>
                            </select>
                            @error('jenis_dokumen')
                                <x-input-error messages="{{ $message }}"></x-input-error>
                            @enderror
                        </div>

                        <!-- Document Number -->
                        <div>
                            <x-input-label for="nomor_dokumen" value="Nomor Dokumen" required />
                            <x-text-input id="nomor_dokumen" name="nomor_dokumen" type="text" class="block w-full"
                                value="{{ old('nomor_dokumen') }}" required />
                            @error('nomor_dokumen')
                                <x-input-error messages="$message"></x-input-error>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 mt-4 md:grid-cols-2">
                        <!-- Issue Date -->
                        <div>
                            <x-input-label for="tanggal_terbit" value="Tanggal Terbit" required />
                            <x-text-input id="tanggal_terbit" name="tanggal_terbit" type="date" class="block w-full"
                                value="{{ old('tanggal_terbit') }}" required />
                            @error('tanggal_terbit')
                                <x-input-error messages="$message"></x-input-error>
                            @enderror
                        </div>

                        <!-- Expiry Date -->
                        <div>
                            <x-input-label for="tanggal_kadaluarsa" value="Tanggal Kadaluarsa" required />
                            <x-text-input id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" type="date"
                                class="block w-full" value="{{ old('tanggal_kadaluarsa') }}" required />
                            @error('tanggal_kadaluarsa')
                                <x-input-error messages="$message"></x-input-error>
                            @enderror
                        </div>
                    </div>

                    <!-- Document File -->
                    <div class="mt-4">
                        <x-input-label for="file_path" value="File Dokumen" required />
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md dark:border-gray-600">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" stroke="currentColor"
                                    fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                    <label for="file_path"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500 dark:bg-gray-800 dark:text-blue-400 dark:hover:text-blue-300">
                                        <span>Upload file</span>
                                        <input id="file_path" name="file_path" type="file" class="sr-only"
                                            accept=".pdf,.jpg,.jpeg,.png" required>
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    PDF, JPG, PNG (maks. 5MB)
                                </p>
                            </div>
                        </div>
                        @error('file_path')
                            <x-input-error messages="$message"></x-input-error>
                        @enderror
                    </div>

                    <!-- Notes -->
                    <div class="mt-4">
                        <x-input-label for="catatan" value="Catatan (Opsional)" />
                        <textarea id="catatan" name="catatan" rows="3"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">{{ old('catatan') }}</textarea>
                        @error('catatan')
                            <x-input-error messages="$message"></x-input-error>
                        @enderror
                    </div>

                    <div class="flex justify-end mt-6 space-x-3">
                        <x-dashboard.button href="{{ route('admin.tank-trucks.show', $tankTruck) }}" variant="secondary">
                            Batal
                        </x-dashboard.button>
                        <x-dashboard.button type="submit" variant="default">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            Upload Dokumen
                        </x-dashboard.button>
                    </div>
                </form>
            </x-dashboard.card.content>
        </x-dashboard.card>
    </div>
</x-dashboard-layout>
