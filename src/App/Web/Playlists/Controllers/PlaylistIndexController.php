<?php

namespace App\Web\Playlists\Controllers;

use App\Web\Playlists\Concerns\WithPlaylists;
use Artesaos\SEOTools\Facades\SEOMeta;
use Domain\Playlists\Models\Playlist;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PlaylistIndexController extends Component
{
    use WithPagination;
    use WithPlaylists;

    #[Url(history: true)]
    public ?string $search = '';

    public function mount(): void
    {
        SEOMeta::setTitle(__('Playlists'));
    }

    public function render(): View
    {
        return view('playlists::index', [
            'items' => $this->builder(),
        ]);
    }

    public function resetQuery(...$properties): void
    {
        collect($properties)
            ->filter(fn (string $property) => in_array($property, ['search']))
            ->map(fn (string $property) => $this->reset($property));

        $this->resetPage();
    }

    protected function builder(): Paginator
    {
        return Playlist::query()
            ->listable()
            ->when(filled($this->search), fn (Builder $query) => $query->search((string) $this->search))
            ->orderByDesc('created_at')
            ->take(12 * 6)
            ->paginate(12);
    }
}
