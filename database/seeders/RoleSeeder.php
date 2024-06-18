<?php

namespace Database\Seeders;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected $primaryKey = 'id'; // Nama kolom UUID
    public $incrementing = false; // Set primary key menjadi non-incrementing
    protected $keyType = 'string';

    public function run(): void
    {
        DB::table('roles')->insert([
            'id' => Uuid::uuid4()->toString(),
            'role_name' => 'Admin',
            'role_code' => 'ADM',
            'kode_level' => null
        ]);

        DB::table('roles')->insert([
            'id' => Uuid::uuid4()->toString(),
            'role_name' => 'Lembaga Penjaminan Mutu',
            'role_code' => 'LPM',
            'kode_level' => null
        ]);

        DB::table('roles')->insert([
            'id' => Uuid::uuid4()->toString(),
            'role_name' => 'Inventaris',
            'role_code' => 'IVN',
            'kode_level' => null
        ]);

        DB::table('roles')->insert([
            'id' => Uuid::uuid4()->toString(),
            'role_name' => 'Penanggung Jawab Sarpras',
            'role_code' => 'PJS',
            'kode_level' => null
        ]);
    }
}
