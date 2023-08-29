<?php

namespace App\Web\Videos\Concerns;

use Domain\Playlists\Actions\CreateVideoHistory;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;
use Livewire\Attributes\Locked;

trait WithVideo
{
    #[Locked]
    public Video $video;

    public function bootWithVideo(): void
    {
        $this->authorize('view', $this->video);
    }

    protected function videoViewed(User $user = null): void
    {
        /** @var User */
        $user ??= auth()->user();

        if (filled($user)) {
            app(CreateVideoHistory::class)->execute($user, $this->video);
        }
    }
}
