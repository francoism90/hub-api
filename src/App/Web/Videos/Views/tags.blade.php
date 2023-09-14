<div {{ $attributes->class('flex flex-wrap gap-x-2.5 gap-y-1 text-sm font-medium') }}>
    @foreach ($items as $item)
        <a
            class="uppercase text-primary-500 hover:text-primary-400"
            href="{{ route('videos.index', ['t[]' => $item->getRouteKey()]) }}"
            wire:navigate>
            {{ $item->name }}
        </a>
    @endforeach
</div>
