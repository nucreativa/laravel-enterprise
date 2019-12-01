<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{
    public function query()
    {
        return User::query();
    }

    public function headings(): array
    {
        return [
            'Email',
            'Name',
            'Roles',
        ];
    }

    public function map($user): array
    {
        return [
            $user->email,
            $user->name,
            implode(', ', $user->getRoleNames()->toArray()),
        ];
    }
}
