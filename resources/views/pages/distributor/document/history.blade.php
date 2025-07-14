<x-dashboard-layout>
    <div class="py-6">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
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
                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                        {{ $histories->links() }}
                    </div>
                @endif
            </x-dashboard.card.content>
        </x-dashboard.card>
    </div>
</x-dashboard-layout>
