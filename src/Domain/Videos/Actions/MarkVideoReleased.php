<?php

namespace Domain\Videos\Actions;

use Domain\Videos\Models\Video;
use Domain\Videos\States\Verified;

class MarkVideoReleased
{
    public function execute(Video $model): void
    {
        if (! $model->state->canTransitionTo(Verified::class)) {
            return;
        }

        $model->state->transitionTo(Verified::class);
    }
}
