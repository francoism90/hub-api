<?php

namespace Domain\Playlists\Models;

use CyrildeWit\EloquentViewable\Contracts\Viewable;
use Domain\Playlists\States\PlaylistState;
use Domain\Shared\Concerns\InteractsWithRandomSeed;
use Domain\Shared\Concerns\InteractsWithViews;
use Domain\Tags\Enums\PlaylistType;
use Domain\Users\Concerns\InteractsWithUser;
use Domain\Videos\Concerns\HasVideos;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Kirschbaum\PowerJoins\PowerJoins;
use Laravel\Scout\Searchable;
use Overtrue\LaravelFavorite\Traits\Favoriteable;
use Overtrue\LaravelFollow\Traits\Followable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\ModelStates\HasStates;
use Spatie\PrefixedIds\Models\Concerns\HasPrefixedId;

class Playlist extends Model implements HasMedia, Viewable
{
    use InteractsWithMedia;
    use InteractsWithRandomSeed;
    use InteractsWithUser;
    use InteractsWithViews;
    use HasFactory;
    use HasPrefixedId;
    use HasStates;
    use HasVideos;
    use Favoriteable;
    use Followable;
    use Notifiable;
    use PowerJoins;
    use Searchable;
    use SoftDeletes;

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
        'user_id',
        'name',
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
        'state' => PlaylistState::class,
        'type' => PlaylistType::class.':nullable',
    ];

    /**
     * @var array<string, string>
     */
    protected $dispatchesEvents = [
        // 'created' => VideoCreated::class,
        // 'saved' => VideoSaved::class,
        // 'deleted' => VideoDeleted::class,
    ];

    // protected static function newFactory(): VideoFactory
    // {
    //     return VideoFactory::new();
    // }

    // public function newEloquentBuilder($query): VideoQueryBuilder
    // {
    //     return new VideoQueryBuilder($query);
    // }

    // public function newCollection(array $models = []): VideoCollection
    // {
    //     return new VideoCollection($models);
    // }

    public function getRouteKeyName(): string
    {
        return 'prefixed_id';
    }

    public function searchableAs(): string
    {
        return 'playlists';
    }

    public function placeholder(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMedia('thumbnail')?->getSrcset()
        )->shouldCache();
    }

    public function thumbnail(): Attribute
    {
        return Attribute::make(
            get: fn () => route('api.videos.thumbnail', $this)
        )->shouldCache();
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->getScoutKey(),
            'name' => $this->name,
            'created' => $this->created_at,
            'updated' => $this->updated_at,
        ];
    }
}
