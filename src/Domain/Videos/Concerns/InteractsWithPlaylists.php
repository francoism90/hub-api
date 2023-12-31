<?php

namespace Domain\Videos\Concerns;

use Domain\Playlists\Models\Playlist;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait InteractsWithPlaylists
{
    public function playlists(): MorphToMany
    {
        return $this->morphedByMany(Playlist::class, 'videoable');
    }
}
