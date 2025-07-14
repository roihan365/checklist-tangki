<x-dashboard-layout>
    <div class="py-6">
        <x-dashboard.card>
            <x-dashboard.card.header>
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                            {{ isset($distributor) ? 'Edit Admin Distributor' : 'Tambah Admin Distributor Baru' }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            {{ isset($distributor) ? 'Perbarui data admin distributor' : 'Tambahkan admin distributor baru ke sistem' }}
                        </p>
                    </div>
                </div>
            </x-dashboard.card.header>

            <x-alert />

            <x-dashboard.card.content>
                <form method="POST"
                    action="{{ isset($distributor) ? route('admin.distributor.update', $distributor) : route('admin.distributor.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @if (isset($distributor))
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Photo -->
                        <div class="col-span-1">
                            <div class="flex items-center justify-center">
                                <div
                                    class="w-32 h-32 rounded-full overflow-hidden border-2 border-gray-200 dark:border-gray-700">
                                    <img id="preview-photo"
                                        src="{{ isset($distributor) && $distributor->photo ? $distributor->photo : asset('images/default-profile.png') }}"
                                        alt="Profile Photo" class="w-full h-full object-cover">
                                </div>
                            </div>
                            <div class="mt-4">
                                <label for="photo"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Foto
                                    Profil</label>
                                <input type="file" id="photo" name="photo" accept="image/*"
                                    class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-blue-50 file:text-blue-700
                                    hover:file:bg-blue-100
                                    dark:file:bg-blue-900 dark:file:text-blue-200
                                    dark:hover:file:bg-blue-800">
                                @error('photo')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Basic Info -->
                        <div class="col-span-1 space-y-4">
                            <div>
                                <x-input-label for="nama" value="Nama Lengkap" />
                                <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full"
                                    value="{{ old('nama', $distributor->nama ?? '') }}" required />
                                @error('nama')
                                    <x-input-error messages="{{ $message }}" />
                                @enderror
                            </div>

                            <div>
                                <x-input-label for="email" value="Email" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                    value="{{ old('email', $distributor->email ?? '') }}" required />
                                @error('email')
                                    <x-input-error messages="{{ $message }}" />
                                @enderror
                            </div>

                            <div>
                                <x-input-label for="password"
                                    value="{{ isset($distributor) ? 'Password Baru (kosongkan jika tidak ingin mengubah)' : 'Password' }}" />
                                <x-text-input id="password" name="password" type="password"
                                    class="mt-1 block w-full" />
                                @error('password')
                                    <x-input-error messages="{{ $message }}" />
                                @enderror
                            </div>

                            @if (isset($distributor))
                                <div>
                                    <x-input-label for="password_confirmation" value="Konfirmasi Password Baru" />
                                    <x-text-input id="password_confirmation" name="password_confirmation"
                                        type="password" class="mt-1 block w-full" />
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-2">
                        <!-- Personal Info -->
                        <div class="space-y-4">
                            <div>
                                <x-input-label for="jenis_kelamin" value="Jenis Kelamin" />
                                <select id="jenis_kelamin" name="jenis_kelamin"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                    <option value="L"
                                        {{ old('jenis_kelamin', $distributor->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="P"
                                        {{ old('jenis_kelamin', $distributor->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <x-input-error messages="{{ $message }}" />
                                @enderror
                            </div>

                            <div>
                                <x-input-label for="tanggal_lahir" value="Tanggal Lahir" />
                                <x-text-input id="tanggal_lahir" name="tanggal_lahir" type="date"
                                    class="mt-1 block w-full"
                                    value="{{ old('tanggal_lahir', isset($distributor) ? \Carbon\Carbon::parse($distributor->tanggal_lahir)->format('Y-m-d') : '') }}"
                                    required />
                                @error('tanggal_lahir')
                                    <x-input-error messages="{{ $message }}" />
                                @enderror
                            </div>
                        </div>

                        <!-- Contact Info -->
                        <div class="space-y-4">
                            <div>
                                <x-input-label for="no_telephone" value="Nomor Telepon" />
                                <x-text-input id="no_telephone" name="no_telephone" type="tel"
                                    class="mt-1 block w-full"
                                    value="{{ old('no_telephone', $distributor->no_telephone ?? '') }}" required />
                                @error('no_telephone')
                                    <x-input-error messages="{{ $message }}" />
                                @enderror
                            </div>

                            @if (isset($distributor))
                                <div>
                                    <x-input-label for="status_registrasi" value="Status Registrasi" />
                                    <select id="status_registrasi" name="status_registrasi"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                        <option value="Berhasil"
                                            {{ old('status_registrasi', $distributor->status_registrasi ?? '') == 'Berhasil' ? 'selected' : '' }}>
                                            Approved</option>
                                        <option value="Non-Berhasil"
                                            {{ old('status_registrasi', $distributor->status_registrasi ?? '') == 'Non-Berhasil' ? 'selected' : '' }}>
                                            Rejected</option>
                                    </select>
                                    @error('status_registrasi')
                                        <x-input-error messages="{{ $message }}" />
                                    @enderror
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-6">
                        <x-input-label for="alamat" value="Alamat" />
                        <textarea id="alamat" name="alamat" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            required>{{ old('alamat', $distributor->alamat ?? '') }}</textarea>
                        @error('alamat')
                            <x-input-error messages="{{ $message }}" />
                        @enderror
                    </div>

                    <div class="flex justify-end mt-6 space-x-3">
                        <x-dashboard.button href="{{ route('admin.distributor.index') }}" variant="secondary">
                            Batal
                        </x-dashboard.button>
                        <x-dashboard.button type="submit" variant="default">
                            {{ isset($distributor) ? 'Update' : 'Simpan' }}
                        </x-dashboard.button>
                    </div>
                </form>
            </x-dashboard.card.content>
        </x-dashboard.card>
    </div>

    @push('scripts')
        <script>
            // Preview photo when selected
            document.getElementById('photo').addEventListener('change', function(event) {
                const [file] = event.target.files;
                if (file) {
                    const preview = document.getElementById('preview-photo');
                    preview.src = URL.createObjectURL(file);
                }
            });
        </script>
    @endpush
</x-dashboard-layout>
