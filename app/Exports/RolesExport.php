<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Spatie\Permission\Models\Role;

class RolesExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{
    public function query()
    {
        return Role::query();
    }

    public function headings(): array
    {
        return [
            'Name',
        ];
    }

    public function map($role): array
    {
        return [
            $role->name,
        ];
    }
}
