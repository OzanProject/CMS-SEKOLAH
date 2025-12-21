<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel, WithHeadingRow
{
    private $classroom_id;

    public function __construct($classroom_id)
    {
        $this->classroom_id = $classroom_id;
    }

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

        return new Student([
            'classroom_id' => $this->classroom_id,
            'nisn'     => $row['nisn'] ?? null,
            'name'     => $row['nama_lengkap'] ?? $row['nama'],
            'gender'   => $row['lp'] ?? $row['jenis_kelamin'] ?? 'L',
        ]);
    }
}
