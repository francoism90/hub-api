<?php

namespace Domain\Tags\Models;

use Database\Factories\TagFactory;
use Domain\Shared\Concerns\InteractsWithRandomSeed;
use Domain\Tags\Collections\TagCollection;
use Domain\Tags\Enums\TagType;
use Domain\Tags\QueryBuilders\TagQueryBuilder;
use Domain\Videos\Models\Video;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\PrefixedIds\Models\Concerns\HasPrefixedId;
use Spatie\Tags\Tag as BaseTag;

class Tag extends BaseTag implements HasMedia
{
    use HasFactory;
    use HasPrefixedId;
    use InteractsWithMedia;
    use InteractsWithRandomSeed;
    use Notifiable;
    use Searchable;

    /**
     * @var array<int, string>
     */
    protected $with = [
        //
    ];

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'adult',
    ];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        //
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'type' => TagType::class.':nullable',
    ];

    /**
     * @var array<int, string>
     */
    public array $translatable = [
        'name',
        'slug',
        'description',
    ];

    protected static function newFactory(): TagFactory
    {
        return TagFactory::new();
    }

    public function newEloquentBuilder($query): TagQueryBuilder
    {
        return new TagQueryBuilder($query);
    }

    public function newCollection(array $models = []): TagCollection
    {
        return new TagCollection($models);
    }

    public function getRouteKeyName(): string
    {
        return 'prefixed_id';
    }

    public function videos(): MorphToMany
    {
        return $this->morphedByMany(Video::class, 'taggable');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('thumbnail')
            ->useDisk('conversions')
            ->singleFile()
            ->acceptsMimeTypes([
                'image/jpg',
                'image/jpeg',
                'image/png',
            ]);
    }

    public function searchableAs(): string
    {
        return 'tags';
    }

    protected function makeAllSearchableUsing(TagQueryBuilder $query): TagQueryBuilder
    {
        return $query->with($this->with);
    }

    public function makeSearchableUsing(TagCollection $models): TagCollection
    {
        return $models->loadMissing($this->with);
    }
}
