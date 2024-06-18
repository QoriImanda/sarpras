<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $kategori = [
            ['kategori' => 'Sarana Ruang Kuliah', 'jenis' => 'Sarana'],
            ['kategori' => 'Sarana Ruang Dosen', 'jenis' => 'Sarana'],
            ['kategori' => 'Sarana Ruang Kantor', 'jenis' => 'Sarana'],
            ['kategori' => 'Sarana Laboratorium', 'jenis' => 'Sarana'],
            ['kategori' => 'Sarana Transportasi', 'jenis' => 'Sarana'],
            ['kategori' => 'Sarana Teknologi Informasi', 'jenis' => 'Sarana'],
            ['kategori' => 'Sarana Toilet', 'jenis' => 'Sarana'],
            ['kategori' => 'Prasarana Lahan', 'jenis' => 'Prasarana'],
            ['kategori' => 'Prasarana Lapangan', 'jenis' => 'Prasarana'],
            ['kategori' => 'Prasarana Gedung', 'jenis' => 'Prasarana'],
            ['kategori' => 'Prasarana Laboratorium', 'jenis' => 'Prasarana'],
            ['kategori' => 'Prasarana Bangunan', 'jenis' => 'Prasarana'],
        ];

        foreach ($kategori as $item) {
            Kategori::create([
                'kategori' => $item['kategori'],
                'jenis' => $item['jenis']
            ]);
        }
    }
}
