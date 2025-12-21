<?php

namespace App\Imports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TeacherImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Skip if name is empty
        if (!isset($row['nama_lengkap']) && !isset($row['nama'])) {
            return null;
        }

        return new Teacher([
            'nip'      => $row['nip'] ?? null,
            'name'     => $row['nama_lengkap'] ?? $row['nama'],
            'gender'   => $row['lp'] ?? $row['jenis_kelamin'] ?? 'L',
        ]);
    }
}
