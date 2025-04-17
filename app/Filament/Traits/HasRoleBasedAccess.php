<?php

namespace App\Filament\Traits;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait HasRoleBasedAccess
{
    public static function canViewAny(): bool
    {
        return Auth::user()?->hasAnyRole(Role::panelRoles());
    }

    public static function canCreate(): bool
    {
        return Auth::user()?->hasAnyRole([Role::ADMIN->value, Role::EDITOR->value]);
    }

    public static function canEdit(Model $record): bool
    {
        return Auth::user()?->hasAnyRole([Role::ADMIN->value, Role::EDITOR->value]);
    }

    public static function canDelete(Model $record): bool
    {
        return Auth::user()?->hasRole([Role::ADMIN->value]);
    }
}
