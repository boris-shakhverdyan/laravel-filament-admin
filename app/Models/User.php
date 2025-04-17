<?php

namespace App\Models;

use Carbon\Carbon;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property ?Carbon $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property Carbon $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Collection<Activity> $created_activities
 * @property Collection<Activity> $favorite_activities
 */
class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function createdActivities(): HasMany
    {
        return $this->hasMany(Activity::class, 'created_by');
    }

    public function favoriteActivities(): BelongsToMany
    {
        return $this->belongsToMany(Activity::class, 'activity_user');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasVerifiedEmail() && $this->hasRole("admin");
    }
}
