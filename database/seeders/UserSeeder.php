<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'username' => 'wakasek01',
                'email' => 'wakasek01@example.com',
                'role' => 1, // role wakasek
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
                'role' => 2, // role guru BK
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
                'role' => 0, // role user biasa
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 2. Wakasek
        DB::table('wakasek')->insert([
            'nip_wakasek' => 12345678,
            'username' => 'wakasek01',
            'nama_wakasek' => 'Pak Wakasek',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Guru BK
        DB::table('guru_bk')->insert([
            'nip_bk' => 87654321,
            'username' => 'gurubk01',
            'nama_guru_bk' => 'Bu Guru BK',
            'created_at' => now(),
            'updated_at' => now(),
        ]);//
    }
}
