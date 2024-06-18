<?php

namespace Database\Seeders;

use App\Models\Gedung;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GedungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gedung::create([
            'label_gedung' => 'A'
        ]);

        Gedung::create([
            'label_gedung' => 'B'
        ]);

        Gedung::create([
            'label_gedung' => 'C'
        ]);

        Gedung::create([
            'label_gedung' => 'D'
        ]);

        Gedung::create([
            'label_gedung' => 'E'
        ]);
    }
}
