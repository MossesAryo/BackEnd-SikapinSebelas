<?php

namespace App\Imports;

use App\Models\User;
use App\Models\guru_bk;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Guru_Bk_Import implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function headingRow(): int
    {
        return 2;
    }
    public function model(array $row)
    {

        \Illuminate\Support\Facades\Log::info('Processing row: ' . json_encode($row));
        if (empty($row['username']) || is_null($row['username'])) {
            \Illuminate\Support\Facades\Log::warning('Null or empty username in row: ' . json_encode($row));
            return null;
        }

        $user = User::Create(
            [
                'username' => $row['username'],
                'email' => $row['username'] . '@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 2,
            ],
        );

        return new guru_bk([
       
            'nip_bk' => $row['nip'],
            'username'      => $user->username,
            'nama_guru_bk' => $row['nama_guru_bk'],
        ]);
    }
}
