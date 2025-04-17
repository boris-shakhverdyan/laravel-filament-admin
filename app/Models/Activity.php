<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property int $id
 * @property string $title
 * @property ?string $description
 * @property ?string $short_description
 * @property ?string $registration_url
 * @property ?int $partner_id
 * @property ?array $location
 * @property int $created_by
 * @property int $activity_type_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property ?Partner $partner
 * @property User $creator
 * @property ActivityType $type
 * @property Collection<User> $favorited_by
 */
class Activity extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'short_description',
        'registration_url',
        'location',
        'partner_id',
        'created_by',
        'activity_type_id',
    ];

    protected $casts = [
        'location' => 'array',
    ];

    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(ActivityType::class, 'activity_type_id');
    }

    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'activity_user');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')->useDisk('public')->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/jpg']);
        $this->addMediaCollection('videos')->useDisk('public')->acceptsMimeTypes(['video/mp4']);
    }
}
