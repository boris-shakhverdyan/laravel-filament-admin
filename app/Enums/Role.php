<?php

namespace App\Enums;

enum Role: string
{
    case ADMIN = 'admin';
    case EDITOR = 'editor';
    case VIEWER = 'viewer';
    case USER = 'user';

    public static function panelRoles(): array
    {
        return [self::ADMIN->value, self::EDITOR->value, self::VIEWER->value];
    }

    public static function values(): array
    {
        return array_map(fn (self $role) => $role->value, self::cases());
    }
}
