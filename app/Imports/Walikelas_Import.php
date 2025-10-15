<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Walikelas;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Walikelas_Import implements ToModel, WithHeadingRow
{
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
        'role' => 3,
      ],
    );
    
    return new Walikelas([
      'nip_walikelas' => $row['nip'],
      'username'      => $user->username,
      'nama_walikelas' => $row['nama_walikelas'],
      'id_kelas'      => $row['id_kelas'],
    ]);
  }
}
