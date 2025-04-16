<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Collection<Activity> $activities
 */
class ActivityType extends Model
{
    protected $fillable = ['name'];

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }
}
