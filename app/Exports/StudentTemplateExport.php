<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class StudentTemplateExport implements WithHeadings, WithTitle
{
    public function headings(): array
    {
        return [
            'No',
            'NISN',
            'Nama Lengkap',
            'L/P',
        ];
    }

    public function title(): string
    {
        return 'Template Siswa';
    }
}
