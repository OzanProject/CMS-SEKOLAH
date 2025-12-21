<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class CommitteeTemplateExport implements WithHeadings, WithTitle
{
    public function headings(): array
    {
        return [
            'No',
            'Nama Lengkap',
            'L/P',
            'Jabatan',
        ];
    }

    public function title(): string
    {
        return 'Template Panitia';
    }
}
