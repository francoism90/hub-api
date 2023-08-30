<?php

namespace App\Web\Account\Controllers;

use App\Web\Videos\Components\Listing;
use Artesaos\SEOTools\Facades\SEOMeta;
use Domain\Playlists\Models\Playlist;
use Domain\Videos\Models\Video;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\View\View;

class HistoryController extends Listing
{
    public function mount(): void
    {
        parent::mount();

        SEOMeta::setTitle(__('History'));
    }

    public function render(): View
    {
        return view('account::history', [
            'items' => $this->builder(),
        ]);
    }

    protected function builder(): Paginator
    {
        return Playlist::query()
            ->history()
            ->first()
            ->videos()
            ->with('tags')
            ->orderByDesc('videoables.updated_at')
            ->take(12 * 6)
            ->paginate(12);
    }
}
