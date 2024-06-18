<?php

namespace Database\Seeders;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AddRoleSeeder extends Seeder
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
            'role_name' => 'Rektor',
            'role_code' => 'REK',
            'kode_level' => null
        ]);
    }
}
