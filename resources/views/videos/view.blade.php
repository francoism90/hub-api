<article>
    <div class="h-64 max-h-64 bg-black sm:h-80 sm:max-h-80 lg:h-[36rem] lg:max-h-[36rem]">
        <x-videos-player
            :item="$video"
            :manifest="$video->stream"
            :starts-at="$this->starts"
            @timeupdate.throttle.750ms="timeUpdate"
            autoplay
        />
    </div>

    <x-ui-container class="py-1">
        <div class="grid grid-cols-1 divide-y divide-gray-700">
            <header class="py-3.5">
                <dl>
                    <dt class="sr-only">{{ __('Published on') }}</dt>
                    <dd class="text-base font-medium leading-6 text-gray-400">
                        <time datetime="{{ $video->published->format('Y-m-d\TH:i:s.uP') }}">
                            {{ $video->published->format('F d, Y') }}
                        </time>
                    </dd>

                    @if ($video->episode || $video->season)
                        <dt class="sr-only">{{ __('ID') }}</dt>
                        <dd class="text-base font-medium leading-6 text-gray-400">
                            {{ $video->identifier }}
                        </dd>
                    @endif
                </dl>

                <h1 class="text-xl font-extrabold capitalize tracking-tight text-gray-100 md:text-3xl">
                    {{ $video->title }}
                </h1>
            </header>

            <div class="grid grid-cols-3 gap-3.5 divide-x divide-gray-700 py-3 text-center text-sm text-gray-300">
                <a
                    class="btn hover:text-primary-300 focus:text-primary-400 active:text-primary-400"
                    wire:click="toggleFavorite"
                >
                    <x-icon
                        :name="$this->favorited"
                        class="h-6 w-6"
                    />
                </a>

                <a
                    class="btn hover:text-primary-300 focus:text-primary-400 active:text-primary-400"
                    wire:click="toggleWatchlist"
                >
                    <x-icon
                        :name="$this->watchlisted"
                        class="h-6 w-6"
                    />
                </a>

                <a
                    class="btn hover:text-primary-300 focus:text-primary-400 active:text-primary-400"
                    href="{{ route('filament.admin.resources.videos.edit', $video) }}"
                >
                    <x-heroicon-o-pencil-square class="h-5 w-5" />
                </a>
            </div>

            @if ($video->tags->isNotEmpty())
                <div class="gap-y-3 py-3.5">
                    <h2 class="text-sm uppercase tracking-wide text-gray-400">{{ __('Tags') }}</h2>
                    <x-videos-tags
                        class="pt-2"
                        :items="$video->tags"
                    />
                </div>
            @endif

            <livewire:videos-similar :$video />
        </div>
    </x-ui-container>
</article>

@script
    <script>
        window.timeUpdate = function(e) {
            const time = e?.target?.currentTime

            if (!time) {
                return;
            }

            Livewire.dispatch('time-update', {
                time
            })
        }
    </script>
@endscript
