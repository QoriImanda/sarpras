<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected $primaryKey = 'id'; // Nama kolom UUID
    public $incrementing = false; // Set primary key menjadi non-incrementing
    protected $keyType = 'string';

    public function run(): void
    {

        $user = User::create([
            'username' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678')
        ]);

        $role = Role::where('role_code', 'ADM')->first();

        DB::table('role_user')->insert([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
    }
}
