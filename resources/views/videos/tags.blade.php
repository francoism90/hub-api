<div {{ $attributes->class('flex flex-wrap gap-x-2.5 gap-y-1 text-sm') }}>
    @foreach ($items as $item)
        <x-ui-link
            class="font-medium uppercase tracking-tight text-primary-500 hover:text-primary-400"
            href="{{ route('home', ['t[]' => $item->getRouteKey()]) }}"
            aria-label="{{ $item->name }}"
            title="{{ $item->name }}"
        >
            {{ $item->name }}
        </x-ui-link>
    @endforeach
</div>
