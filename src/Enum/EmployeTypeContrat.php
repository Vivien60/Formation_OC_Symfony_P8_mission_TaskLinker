<?php

namespace App\Enum;

enum EmployeTypeContrat: string
{
    case CDI = 'CDI';
    case CDD = 'CDD';

    public function getLabel(): string
    {
        return $this->value;
    }
}
