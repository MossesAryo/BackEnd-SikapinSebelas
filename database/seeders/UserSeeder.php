<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'username' => 'wakasek01',
                'email' => 'wakasek01@example.com',
                'role' => 1,
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'username' => 'gurubk01',
                'email' => 'gurubk01@example.com',
                'role' => 2,
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'username' => 'user01',
                'email' => 'user01@example.com',
                'role' => 0,
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'username' => 'kepala_program',
                'email' => 'kepala_program@example.com',
                'role' => 3,
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ✅ Tambahan user guru BK real
            [
                'id' => 4,
                'username' => 'amel',
                'email' => 'amel@example.com',
                'role' => 2,
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'username' => 'ratihpratiwi',
                'email' => 'ratihpratiwi@example.com',
                'role' => 2,
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'username' => 'suci',
                'email' => 'suci@example.com',
                'role' => 2,
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'username' => 'evifebry',
                'email' => 'evifebry@example.com',
                'role' => 2,
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'username' => 'weningwigati',
                'email' => 'weningwigati@example.com',
                'role' => 2,
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 2️⃣ Wakasek
        DB::table('wakasek')->insert([
            'nip_wakasek' => 12345678,
            'username' => 'wakasek01',
            'nama_wakasek' => 'Pak Wakasek',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3️⃣ Guru BK
        DB::table('guru_bk')->insert([
            'nip_bk' => 87654321,
            'username' => 'gurubk01',
            'nama_guru_bk' => 'Bu Guru BK',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('ketua_program')->insert([
            'nip_kaprog' => 777,
            'username' => 'kepala_program',
            'nama_ketua_program' => 'Pak Ketua Program',
            'jurusan' => 'TKJ',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3️⃣ Guru BK
    
    }
}
