<?php

namespace Domain\Playlists\Actions;

use Domain\Playlists\Enums\PlaylistType;
use Domain\Playlists\States\Verified;
use Domain\Users\Models\User;

class InitializePlaylists
{
    public function execute(User $user): void
    {
        $items = collect([
            ['name' => 'favorites', 'type' => PlaylistType::system()],
            ['name' => 'history', 'type' => PlaylistType::system()],
            ['name' => 'watchlist', 'type' => PlaylistType::system()],
        ]);

        $items->each(function (array $item) use ($user) {
            $playlist = app(CreatePlaylist::class)->execute($user, $item);

            if ($playlist->state->canTransitionTo(Verified::class)) {
                $playlist->state->transitionTo(Verified::class);
            }
        });
    }
}
