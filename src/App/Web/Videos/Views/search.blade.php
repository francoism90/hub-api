<x-layouts::dialog>
    <x-heroicon-m-magnifying-glass
        @click="open = true"
        class="h-6 w-6" />

    <x-slot:content>
        <div class="m-5 w-full max-w-3xl rounded bg-gray-800 shadow-md sm:mt-14">
            <header class="flex items-center space-x-4 px-4 relative">
                <x-heroicon-o-magnifying-glass class="h-6 w-6 text-gray-300" />

                <input
                    type="search"
                    class="bg-transparent border-transparent h-12 focus:outline-none w-full"
                    placeholder="{{ __('Search') }}"
                    wire:model.live.debounce.250ms="search"
                >

                <button
                    class="rounded-sm bg-gray-600 py-1 px-2 text-xs text-gray-200"
                    @click="open = false">
                        {{ __('ESC') }}
                </button>
            </header>

            <div class="border-t border-gray-700">
                @if (blank($search))
                    <div class="px-4 py-20 text-center text-gray-300">
                        No recent searches
                    </div>
                @endif

                {{ $search }}
            </div>
        </div>
    </x-slot:content>
</x-layouts::dialog>
