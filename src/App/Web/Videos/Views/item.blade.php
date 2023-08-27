<article class="rounded bg-gray-700/40 p-4 shadow-md">
    <div class="flex flex-row flex-nowrap items-center space-x-4">
        <div class="h-16 w-16 flex-none">
            <a href="{{ route('videos.view', $item) }}">
                <img
                    alt="{{ $item->name }}"
                    src="{{ $item->thumbnail }}"
                    class="h-full w-full bg-black object-cover text-transparent"
                    crossorigin="use-credentials"
                    loading="lazy" />
            </a>
        </div>

        <div class="grow">
            <div class="flex flex-col space-y-1.5">
                <dl>
                    <dt class="sr-only">Published on</dt>
                    <dd class="hidden text-ellipsis text-sm font-medium leading-4 text-gray-400 sm:block">
                        <time datetime="{{ $item->created_at->format('Y-m-d\TH:i:s.uP') }}">
                            {{ $item->created_at->format('F d, Y') }}
                        </time>
                    </dd>
                </dl>

                <h2 class="line-clamp-2 text-sm font-bold capitalize leading-6 tracking-tight">
                    <a href="{{ route('videos.view', $item) }}">
                        {{ $item->name }}
                    </a>
                </h2>

                @if ($item->tags)
                    <x-videos::tags :items="$item->tags" />
                @endif
            </div>
        </div>
    </div>
</article>
