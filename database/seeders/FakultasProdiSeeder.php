<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FakultasProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        /////// Fakultas Ilmu Kesehatan

            DB::table('Fakultas')->insert([
                'nama_fakultas' => 'Fakultas Ilmu Kesehatan',
                'slug' => 'fakultas-ilmu-kesehatan',
                'kode_fakultas' => 'FIK'
            ]);

            /////// prodi

                DB::table('prodis')->insert([
                    'nama_prodi' => 'Program Studi S1 Gizi',
                    'kode_prodi' => 'S1-GIZI',
                    'slug' => 'program-studi-s1-gizi',
                    'fakultas_id' => 1
                ]);

                DB::table('prodis')->insert([
                    'nama_prodi' => 'Program Studi S1 Kesehatan Masyarakat',
                    'kode_prodi' => 'S1-KESMAS',
                    'slug' => 'program-studi-s1-kesehatan-masyaratak',
                    'fakultas_id' => 1
                ]);

                DB::table('prodis')->insert([
                    'nama_prodi' => 'Program Studi S1 Keperawatan',
                    'kode_prodi' => 'S1-KEP',
                    'slug' => 'program-studi-s1-keperawata',
                    'fakultas_id' => 1
                ]);

                DB::table('prodis')->insert([
                    'nama_prodi' => 'Program Studi S1 Kebidanan dan Pendidikan Profesi Bidan',
                    'kode_prodi' => 'S1-KPPB',
                    'slug' => 'program-studi-s1-kebidanan-dan-pendidikan-profesi-bidan',
                    'fakultas_id' => 1
                ]);

                DB::table('prodis')->insert([
                    'nama_prodi' => 'Profesi Ners',
                    'kode_prodi' => 'P-NS',
                    'slug' => 'profesi-ners',
                    'fakultas_id' => 1
                ]);

                // DB::table('prodis')->insert([
                //     'nama_prodi' => 'Program Studi DIV Kebidanan',
                //     'kode_prodi' => 'DIV-KEB',
                //     'fakultas_id' => 1
                // ]);

                DB::table('prodis')->insert([
                    'nama_prodi' => 'Program Studi DIII Keperawatan',
                    'kode_prodi' => 'DIII-KEP',
                    'slug' => 'program-studi-diii-keperawatan',
                    'fakultas_id' => 1
                ]);

                DB::table('prodis')->insert([
                    'nama_prodi' => 'Program Studi DIII Kebidanan',
                    'kode_prodi' => 'DIII-KEB',
                    'slug' => 'program-studi-diii-kebidanan',
                    'fakultas_id' => 1
                ]);

                DB::table('prodis')->insert([
                    'nama_prodi' => 'Program Studi DIV Bidan Pendidik',
                    'kode_prodi' => 'DIV-BP',
                    'slug' => 'program-studi-div-bidan-pendidik',
                    'fakultas_id' => 1
                ]);

        /////// End Fakultas Ilmu Kesehatan

        /////// Fakultas Ilmu Pendidikan

            DB::table('Fakultas')->insert([
                'nama_fakultas' => 'Fakultas Ilmu Pendidikan',
                'kode_fakultas' => 'FIP',
                'slug' => 'fakultas-ilmu-pendidikan'
            ]);

                //// prodi
                DB::table('prodis')->insert([
                    'nama_prodi' => 'Pendidikan Profesi Guru',
                    'kode_prodi' => 'PPG',
                    'slug' => 'pendidikan-profesi-guru',
                    'fakultas_id' => 2
                ]);

                DB::table('prodis')->insert([
                    'nama_prodi' => 'Program Studi S1 PGSD',
                    'kode_prodi' => 'S1-PGSD',
                    'slug' => 'program-studi-s1-guru',
                    'fakultas_id' => 2
                ]);

                DB::table('prodis')->insert([
                    'nama_prodi' => 'Program Studi S1 PG PAUD',
                    'kode_prodi' => 'S1-PGPAUD',
                    'slug' => 'program-studi-s1-pg-paud',
                    'fakultas_id' => 2
                ]);

                DB::table('prodis')->insert([
                    'nama_prodi' => 'Program Studi S1 Pendidikan Matematika',
                    'kode_prodi' => 'S1-PMTK',
                    'slug' => 'program-studi-s1-pendidikan-matematika',
                    'fakultas_id' => 2
                ]);

                DB::table('prodis')->insert([
                    'nama_prodi' => 'Program Studi S1 Pendidikan Bahasa Inggris',
                    'kode_prodi' => 'S1-PBI',
                    'slug' => 'program-studi-s1-pendidikan-bahasa-inggris',
                    'fakultas_id' => 2
                ]);

                DB::table('prodis')->insert([
                    'nama_prodi' => 'Program Studi S1 Penjaskesrek',
                    'kode_prodi' => 'S1-PJKK',
                    'slug' => 'program-studi-s1-penjaskesrek',
                    'fakultas_id' => 2
                ]);

                DB::table('prodis')->insert([
                    'nama_prodi' => 'Program Studi S2 Pendidikan Dasar',
                    'kode_prodi' => 'S2-PDD',
                    'slug' => 'program-studi-s2-pendidikan-dasar',
                    'fakultas_id' => 2
                ]);
        /////// End Fakultas Ilmu Pendidikan

        /////// Fakultas Teknik

            DB::table('Fakultas')->insert([
                'nama_fakultas' => 'Fakultas Teknik',
                'kode_fakultas' => 'FT',
                'slug' => 'fakultas-teknik'
            ]);

                //// prodi
                DB::table('prodis')->insert([
                    'nama_prodi' => 'Program Studi S1 Teknik Informatika',
                    'kode_prodi' => 'S1-TIF',
                    'slug' => 'program-studi-s1-teknik-informatika',
                    'fakultas_id' => 3
                ]);

                DB::table('prodis')->insert([
                    'nama_prodi' => 'Program Studi S1 Teknik Industri',
                    'kode_prodi' => 'S1-TID',
                    'slug' => 'program-studi-s1-teknik-industri',
                    'fakultas_id' => 3
                ]);

                DB::table('prodis')->insert([
                    'nama_prodi' => 'Program Studi S1 Teknik Sipil',
                    'kode_prodi' => 'S1-TSP',
                    'slug' => 'program-studi-s1-teknik-sipil',
                    'fakultas_id' => 3
                ]);

        /////// End Fakultas Teknik

        /////// Fakultas Hukum

            DB::table('Fakultas')->insert([
                'nama_fakultas' => 'Fakultas Hukum',
                'kode_fakultas' => 'FH',
                'slug' => 'fakultas-hukum'
            ]);

                ///// prodi
                DB::table('prodis')->insert([
                    'nama_prodi' => 'Program Studi S1 Hukum',
                    'kode_prodi' => 'S1-HKM',
                    'slug' => 'program-studi-s1-hukum',
                    'fakultas_id' => 4
                ]);

        /////// End Fakultas Hukum

        /////// Fakultas Fakultas Ekonomi Dan Bisnis

            DB::table('Fakultas')->insert([
                'nama_fakultas' => 'Fakultas Ekonomi Dan Bisnis',
                'kode_fakultas' => 'FEB',
                'slug' => 'fakultas-ekonomi-dan-bisnis'
            ]);

                ///// prodi
                DB::table('prodis')->insert([
                    'nama_prodi' => 'Program Studi S1 Kewirausahaan',
                    'kode_prodi' => 'S1-KEW',
                    'slug' => 'program-studi-s1-kewirausahaan',
                    'fakultas_id' => 5
                ]);

                DB::table('prodis')->insert([
                    'nama_prodi' => 'Program Studi S1 Bisnis Digital',
                    'kode_prodi' => 'S1-BD',
                    'slug' => 'program-studi-s1-bisnis-digital',
                    'fakultas_id' => 5
                ]);

        /////// End Fakultas Ekonomi Dan Bisnis

        /////// Fakultas Ilmu Hayati

            DB::table('Fakultas')->insert([
                'nama_fakultas' => 'Fakultas Ilmu Hayati',
                'kode_fakultas' => 'FIH',
                'slug' => 'fakultas-ilmu-hayati'
            ]);

                ///// prodi
                DB::table('prodis')->insert([
                    'nama_prodi' => 'Program Studi S1 Peternakan',
                    'kode_prodi' => 'S1-PET',
                    'slug' => 'program-studi-s1-peternakan',
                    'fakultas_id' => 6
                ]);

                DB::table('prodis')->insert([
                    'nama_prodi' => 'Program Studi S1 Biologi',
                    'kode_prodi' => 'S1-BIO',
                    'slug' => 'program-studi-s1-biologi',
                    'fakultas_id' => 6
                ]);

        /////// End Fakultas Ilmu Hayati

        /////// Fakultas Ilmu Hayati

            DB::table('Fakultas')->insert([
                'nama_fakultas' => 'Fakultas Agama Islam',
                'kode_fakultas' => 'FAI',
                'slug' => 'fakultas-agama-islam'
            ]);

                ///// prodi
                DB::table('prodis')->insert([
                    'nama_prodi' => 'Program Studi S1 Ekonomi Syariah',
                    'kode_prodi' => 'PSES',
                    'slug' => 'program-studi-s1-ekonomi-syariah',
                    'fakultas_id' => 7
                ]);

                DB::table('prodis')->insert([
                    'nama_prodi' => 'Program Studi S1 Perbankan Syariah',
                    'kode_prodi' => 'S1-PBS',
                    'slug' => 'program-studi-s1-perbankan-syariah',
                    'fakultas_id' => 7
                ]);

        /////// End Fakultas Ilmu Hayati

        /////// Fakultas S2 pendidikan dasar

        // DB::table('Fakultas')->insert([
        //     'nama_fakultas' => 'Fakultas Pascasarjana',
        //     'kode_fakultas' => 'FPS'
        // ]);

            //// prodi
            DB::table('prodis')->insert([
                'nama_prodi' => 'Program Studi S2 Pendidikan Dasar',
                'kode_prodi' => 'S2-PDD',
                'slug' => 'program-studi-s2-pendidikan-dasar',
                'fakultas_id' => 2
            ]);
        /////// End Fakultas S2 pendidikan dasar



    }
}
