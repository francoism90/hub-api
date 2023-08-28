<div>
    <x-layouts::container class="py-5">
        <x-layouts::navbar />
    </x-layouts::container>

    <article>
        <x-videos::player
            :model="$video"
            :manifest="$video->stream"
            class="h-64 max-h-64 w-full bg-black lg:h-[32rem] lg:max-h-[32rem]"
            autoplay />

        <x-layouts::container>
            <div class="grid grid-cols-1 divide-y divide-gray-700">
                <header class="py-5">
                    <dl>
                        <dt class="sr-only">Published on</dt>
                        <dd class="text-base font-medium leading-6 text-gray-400">
                            <time datetime="{{ $video->created_at->format('Y-m-d\TH:i:s.uP') }}">
                                {{ $video->created_at->format('F d, Y') }}
                            </time>
                        </dd>

                        @if ($video->episode || $video->season)
                            <dt class="sr-only">Episode</dt>
                            <dd class="text-base font-medium leading-6 text-gray-400">
                                {{ $video->season }}{{ $video->episode }}
                            </dd>
                        @endif
                    </dl>

                    <h1 class="text-xl font-extrabold capitalize tracking-tight text-gray-100 md:text-3xl">
                        {{ $video->name }}
                    </h1>
                </header>

                <div
                    class="grid grid-cols-2 divide-x divide-gray-700 py-5 text-center text-sm text-gray-300 hover:text-gray-100">
                    <a>Add to Playlist</a>

                    @can('update', $video)
                        <a href="{{ route('filament.admin.resources.videos.edit', $video) }}">Edit Video</a>
                    @endcan
                </div>

                @if ($video->tags)
                    <div class="space-y-1 py-5">
                        <h2 class="text-sm uppercase tracking-wide text-gray-400">{{ __('Tags') }}</h2>
                        <x-videos::tags :items="$video->tags" />
                    </div>
                @endif

                <div class="space-y-1 py-5">
                    <h2 class="text-sm uppercase tracking-wide text-gray-400">{{ __('Similar videos') }}</h2>
                </div>
            </div>
        </x-layouts::container>
    </article>

    <x-layouts::footer />
</div>
