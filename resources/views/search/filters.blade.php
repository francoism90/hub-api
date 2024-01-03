<div class="flex w-full flex-row flex-nowrap gap-x-6">
    @if (filled($this->form->search))
        <x-ui-dropdown>
            <button class="btn text-sm font-semibold">
                <span>{{ $this->sorter }}</span>
                <x-heroicon-m-chevron-down
                    class="h-4 w-4"
                    x-bind:class="open ? 'rotate-180' : ''"
                />
            </button>

            <x-slot:content>
                <div
                    x-anchor.bottom-start.offset.10="$refs.dropdown"
                    x-on:click.away="open = false"
                    class="dropdown-content w-44 min-w-[11rem] max-w-[11rem] rounded bg-gray-900 py-2"
                >
                    @foreach ($this->sorters as $key => $label)
                        <label
                            for="sort-{{ $key }}"
                            class="btn @if ($this->form->hasSort($key)) btn-gradient @endif justify-start px-4 py-2 text-sm"
                        >
                            <span>{{ $label }}</span>
                            @if ($this->form->hasSort($key))
                                <x-heroicon-o-check class="h-4 w-4" />
                            @endif
                        </label>

                        <input
                            id="sort-{{ $key }}"
                            type="radio"
                            class="hidden"
                            value="{{ $key }}"
                            wire:model.live="form.sort"
                        />
                    @endforeach
                </div>
            </x-slot:content>
        </x-ui-dropdown>

        <x-ui-dropdown>
            <button class="btn text-sm font-semibold">
                <span>{{ __('Features') }}</span>
                <x-heroicon-m-chevron-down
                    class="h-4 w-4"
                    x-bind:class="open ? 'rotate-180' : ''"
                />
            </button>

            <x-slot:content>
                <div
                    x-anchor.bottom-start.offset.10="$refs.dropdown"
                    x-on:click.away="open = false"
                    class="dropdown-content w-44 min-w-[11rem] max-w-[11rem] rounded bg-gray-900 py-2"
                >
                    @foreach ($this->features as $key => $label)
                        <label
                            for="feature-{{ $key }}"
                            class="btn @if ($this->hasFeature($key)) btn-gradient @endif justify-start px-4 py-2 text-sm"
                        >
                            <span>{{ $label }}</span>
                            @if ($this->hasFeature($key))
                                <x-heroicon-o-check class="h-4 w-4" />
                            @endif
                        </label>

                        <input
                            id="feature-{{ $key }}"
                            type="checkbox"
                            class="hidden"
                            value="{{ $key }}"
                            wire:model.live="form.feature"
                        />
                    @endforeach
                </div>
            </x-slot:content>
        </x-ui-dropdown>
    @endif
</div>