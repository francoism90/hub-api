<?php

namespace App\Filament\Resources\TagResource\Pages;

use App\Filament\Concerns\InteractsWithFormData;
use App\Filament\Resources\TagResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;
use Illuminate\Contracts\Support\Htmlable;

class EditTag extends EditRecord
{
    use InteractsWithFormData;
    use Translatable;

    protected static string $resource = TagResource::class;

    public function getTitle(): string|Htmlable
    {
        return static::getRecordTitle();
    }

    public function getContentTabLabel(): ?string
    {
        return __('General');
    }

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),

            Actions\DeleteAction::make()
                ->icon('heroicon-o-trash'),
        ];
    }
}
