<?php

namespace App\Web\Videos\Components;

use Domain\Tags\Collections\TagCollection;
use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Reactive;

class Filters extends Component
{
    #[Reactive]
    public ?string $tag = null;

    #[Reactive]
    public ?string $search = null;

    public ?string $type = 'genre';

    public function render(): View
    {
        return view('videos::filters');
    }

    public function mount(): void
    {
        $this->select();
    }

    #[Computed]
    public function tags(): TagCollection
    {
        return Tag::query()
            ->type($this->type)
            ->orderBy('name')
            ->get()
            ->sortByDesc(fn (Tag $item) => $item->getRouteKey() === $this->tag);
    }

    #[Computed]
    public function name(): string
    {
        return TagType::tryFrom($this->type)->label;
    }

    public function select(): void
    {
        if (blank($this->tag)) {
            return;
        }

        $types = collect(TagType::toValues());

        $tag = Tag::findByPrefixedId($this->tag);

        $this->type = $tag instanceof Tag && filled($tag->type)
            ? $types->first(fn (string $type) => $tag->type->value === $type)
            : $types->first();
    }

    public function toggle(): void
    {
        $types = collect(TagType::toValues());

        $this->type = $types->after($this->type, $types->first());
    }
}
