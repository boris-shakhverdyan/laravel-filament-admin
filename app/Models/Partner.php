<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property ?string $website
 * @property ?string $logo
 * @property ?array $location
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Collection<Activity> $activities
 */
class Partner extends Model
{
    protected $fillable = ['name', 'website', 'logo', 'location'];

    protected $casts = [
        'location' => 'array',
    ];

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }
}
