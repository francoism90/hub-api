<header>
    <x-layouts::container class="navbar">
        <a
            href="/"
            class="navbar-brand"
            wire:navigate>
            <x-heroicon-s-play-circle class="navbar-logo" />
            <span>{{ config('app.name') }}</span>
        </a>

        <nav class="navbar-menu">
            <a
                href="{{ route('tags.index') }}"
                class="{{ $active('tags', 'navbar-item') }}"
                aria-label="{{ __('Tags') }}"
                title="{{ __('Tags') }}"
                wire:navigate>
                <x-heroicon-o-hashtag class="h-6 w-6" />
            </a>

            <a
                href="{{ route('search') }}"
                class="{{ $active('search', 'navbar-item') }}"
                aria-label="{{ __('Search') }}"
                title="{{ __('Search') }}"
                wire:navigate>
                <x-heroicon-o-magnifying-glass class="h-6 w-6" />
            </a>

            <x-layouts::dropdown>
                <a class="navbar-item">
                    <x-heroicon-o-user-circle class="h-6 w-6" />
                </a>

                <x-slot:content>
                    <div
                        x-on:click.away="open = false"
                        class="dropdown-content right-0 top-10 flex min-w-[16rem] max-w-[16rem] flex-col gap-y-4 bg-gray-900 px-6 py-4">
                        <div class="flex flex-col flex-nowrap gap-y-1">
                            <a
                                href="{{ route('profile.history') }}"
                                class="{{ $active('profile.history', 'navbar-item text-gray-400') }}"
                                wire:navigate>
                                {{ __('History') }}
                            </a>

                            <a
                                href="{{ route('profile.favorites') }}"
                                class="{{ $active('profile.favorites', 'navbar-item text-gray-400') }}"
                                wire:navigate>
                                {{ __('Favorites') }}
                            </a>

                            <a
                                href="{{ route('profile.watchlist') }}"
                                class="{{ $active('profile.watchlist', 'navbar-item text-gray-400') }}"
                                wire:navigate>
                                {{ __('Watchlist') }}
                            </a>
                        </div>

                        <div class="flex flex-col flex-nowrap gap-y-1">
                            <a
                                href="{{ route('filament.admin.pages.dashboard') }}"
                                class="navbar-item text-gray-400">
                                {{ __('Manage Profile') }}
                            </a>
                        </div>

                        <button
                            class="btn rounded bg-gray-600/50 py-2 text-sm font-medium"
                            href="{{ route('filament.admin.auth.logout') }}">
                            {{ __('Log Out') }}
                        </button>
                    </div>
                </x-slot:content>
            </x-layouts::dropdown>
        </nav>
    </x-layouts::container>
</header>