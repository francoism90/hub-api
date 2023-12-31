<?php

namespace App\Web\Profile\Controllers;

use App\Web\Playlists\Concerns\WithWatchlist;
use App\Web\Profile\Concerns\WithAuthentication;
use App\Web\Videos\Components\Listing;
use Artesaos\SEOTools\Facades\SEOMeta;
use Domain\Videos\Models\Video;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Attributes\Computed;

class WatchlistController extends Listing
{
    use WithAuthentication;
    use WithWatchlist;

    protected static string $model = Video::class;

    public function mount(): void
    {
        SEOMeta::setTitle(__('Watchlist'));
    }

    public function render(): View
    {
        return view('videos::index');
    }

    #[Computed]
    public function builder(): Paginator
    {
        return static::watchlist()
            ->videos()
            ->published()
            ->orderByDesc('videoables.updated_at')
            ->when($this->form->isSort('oldest'), fn (Builder $query) => $query->reorder()->orderBy('videoables.updated_at'))
            ->when($this->form->isSort('published'), fn (Builder $query) => $query->reorder()->orderByDesc('created_at'))
            ->when($this->form->hasSearch(), fn (Builder $query) => $query->search($this->form->getSearch(), true))
            ->take(32 * 32)
            ->paginate(32);
    }

    #[Computed]
    public function sorters(): array
    {
        return [
            '' => __('Date added (newest)'),
            'oldest' => __('Date added (oldest)'),
            'published' => __('Date published'),
        ];
    }
}
