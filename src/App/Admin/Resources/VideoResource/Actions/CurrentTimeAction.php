<?php

namespace App\Admin\Resources\VideoResource\Actions;

use App\Admin\Concerns\InteractsWithPlaylists;
use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Component;
use Illuminate\Database\Eloquent\Model;

class CurrentTimeAction extends Action
{
    use CanCustomizeProcess;
    use InteractsWithPlaylists;

    public static function getDefaultName(): ?string
    {
        return 'current_time';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->icon('heroicon-o-camera');

        $this->label(__('Current Time'));

        $this->hiddenLabel();

        $this->action(function (): void {
            $this->process(function (Component $component, Model $record, mixed $state = null) {
                $videoable = static::getHistory()
                    ?->videos()
                    ?->firstWhere('id', $record->getKey());

                $component->state(
                    $videoable?->pivot?->options['timestamp'] ?: $state
                );
            });

            $this->success();
        });
    }
}
