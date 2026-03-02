<?php

namespace App\Enum;

enum EmployeRole: string
{
    case ROLE_ADMIN = 'Chef de projet';
    case ROLE_USER = 'Employé';

    public function getLabel(): string
    {
        return $this->value;
    }

    public static function default(): self
    {
        return self::ROLE_USER;
    }
}
