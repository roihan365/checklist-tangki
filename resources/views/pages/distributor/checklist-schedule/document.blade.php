<x-dashboard-layout>
    <div class="py-6">
        <div class="py-4">
            <x-dashboard.card>
                <x-dashboard.card.header>
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Dokumen Terakhir
                            </h2>
                        </div>
                    </div>
                    <x-alert />
                </x-dashboard.card.header>

                <x-dashboard.card.content>
                    @if ($documents->isEmpty())
                        <p class="text-gray-500 dark:text-gray-400">Belum ada dokumen yang diunggah.</p>
                    @else
                        <ul class="space-y-4">
                            @foreach ($documents as $document)
                                <li
                                    class="flex items-center justify-between p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $document->created_at }}
                                            {{-- | {{ $document->file_path }} --}}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            Status:
                                            @if ($document->status == 'completed')
                                                <span class="text-green-600 dark:text-green-400">Completed</span>
                                            @else
                                                <span class="text-red-600 dark:text-red-400">Rejected</span>
                                            @endif
                                            | Diunggah oleh: {{ $document->petugas->nama }}
                                        </p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ Storage::url($document->file_path) }}"
                                            class="text-blue-600 dark:text-blue-400 hover:underline" target="_blank"
                                            rel="noopener noreferrer">
                                            Lihat Dokumen
                                        </a>
                                        {{-- <form action="{{ route('admin.checklist-schedule.delete-document', $document) }}"
                                            method="POST" onsubmit="return confirm('Yakin ingin menghapus dokumen ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 dark:text-red-400 hover:underline">Hapus</button>
                                        </form> --}}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </x-dashboard.card.content>
            </x-dashboard.card>
        </div>
    </div>
</x-dashboard-layout>
