<?php

namespace App\Constants;

class UserRole
{
    const SUPERADMIN = 'super_admin';
    const MODERATOR = 'moderator';
    const EDITOR = 'editor';
    const USER = 'user';
    const SUPERUSER = 'superuser';
    const NEWUSER = 'new_user';

    /**
     * @return string[]
     */
    public static function getRoleList(): array
    {
        return [
            self::SUPERADMIN => 'super_admin',
            self::MODERATOR => 'moderator',
            self::EDITOR => 'editor',
            self::SUPERUSER => 'superuser',
            self::USER => 'user',
            self::NEWUSER => 'new_user'
        ];
    }

    /**
     * @param string $role_code
     * @return string
     */
    public static function getRoleName(string $role_code): string
    {
        return match ($role_code) {
            self::SUPERADMIN => 'super_admin',
            self::MODERATOR => 'moderator',
            self::EDITOR => 'editor',
            self::SUPERUSER => 'superuser',
            self::USER => 'user',
            self::NEWUSER => 'new_user',
            default => '',
        };
    }
}