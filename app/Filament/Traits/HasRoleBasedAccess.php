<?php

namespace App\Filament\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait HasRoleBasedAccess
{
    public static function canViewAny(): bool
    {
        return Auth::user()?->hasAnyRole(['admin', 'editor', 'viewer']);
    }

    public static function canCreate(): bool
    {
        return Auth::user()?->hasAnyRole(['admin', 'editor']);
    }

    public static function canEdit(Model $record): bool
    {
        return Auth::user()?->hasAnyRole(['admin', 'editor']);
    }

    public static function canDelete(Model $record): bool
    {
        return Auth::user()?->hasRole('admin');
    }
}
