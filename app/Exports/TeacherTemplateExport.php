<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class TeacherTemplateExport implements WithHeadings, WithTitle
{
    public function headings(): array
    {
        return [
            'No',
            'NIP',
            'Nama Lengkap',
            'L/P',
        ];
    }

    public function title(): string
    {
        return 'Template Guru';
    }
}
