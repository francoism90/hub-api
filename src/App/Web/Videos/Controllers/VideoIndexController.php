<?php

namespace App\Web\Videos\Controllers;

use App\Web\Videos\Forms\QueryForm;
use App\Web\Videos\States\SortState;
use App\Web\Videos\States\TagsState;
use Domain\Videos\Models\Video;
use Foxws\LivewireUse\Views\Components\Page;
use Foxws\LivewireUse\Views\Concerns\WithQueryBuilder;
use Foxws\LivewireUse\Views\Concerns\WithState;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class VideoIndexController extends Page
{
    use WithState;
    use WithPagination;
    use WithQueryBuilder;

    protected static string $model = Video::class;

    protected static array $states = [
        TagsState::class,
        // SortState::class,
    ];

    #[Url(as: 'q', history: true, except: '')]
    public ?string $search = null;

    #[Url(as: 't', history: true, except: '')]
    public ?string $tag = null;

    public QueryForm $form;

    public function render(): View
    {
        return view('videos.index');
    }

    public function boot(): void
    {
        $query = array_filter(
            $this->only('search', 'tag')
        );

        $this->all();

        $this->form->fill($query);

        $this->form->submit();
    }

    #[Computed]
    public function items(): LengthAwarePaginator
    {
        return $this->getQuery()
            ->recommended()
            ->when($this->form->getSearch(), fn (Builder $query, string $value = '') => $query->search($value))
            ->when($this->form->getTag(), fn (Builder $query, string $value = '') => $query->tagged((array) $value))
            ->paginate(16);
    }
}
