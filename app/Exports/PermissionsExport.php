<?php

namespace App\Exports;

use App\Permission;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PermissionsExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{
    public function query()
    {
        return Permission::query();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Group',
        ];
    }

    public function map($permission): array
    {
        return [
            $permission->name,
            optional($permission->group)->name,
        ];
    }
}
