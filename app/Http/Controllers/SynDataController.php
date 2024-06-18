<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SynDataController extends Controller
{
    public function synDataFakultasProdi()
    {
        $responseLogin = Http::withHeaders([
            // 'Authorization' => 'Bearer your_access_token',
            // 'Custom-Header' => 'Header-Value',
        ])
            ->post('https://sains.universitaspahlawan.ac.id/api/login', [
                'username' => '1855201031',
                'password' => '1855201031'
            ]);
        $data = json_decode($responseLogin);

        try {
            $responDataFakultas = Http::withHeaders([
                'Authorization' => 'Bearer' . ' ' . $data->token,
                // 'Custom-Header' => 'Header-Value',
            ])->get('https://sains.universitaspahlawan.ac.id/api/fakultas');

            $fakultasByApi = json_decode($responDataFakultas)->data;

            for ($i = 0; $i < count($fakultasByApi); $i++) {
                $findFakultas = Fakultas::where('kode_fakultas', $fakultasByApi[$i]->id_sms)->first();
                if ($findFakultas == null) {
                    $fakultas = new Fakultas();
                    $fakultas->kode_fakultas = $fakultasByApi[$i]->id_sms;
                    $fakultas->nama_fakultas = $fakultasByApi[$i]->nm_lemb;
                    $fakultas->slug = str_replace(" ", "-", $fakultasByApi[$i]->nm_lemb);
                    $fakultas->save();
                } else {
                    $fakultas = $findFakultas;
                    $fakultas->kode_fakultas = $fakultasByApi[$i]->id_sms;
                    $fakultas->nama_fakultas = $fakultasByApi[$i]->nm_lemb;
                    $fakultas->slug = str_replace(" ", "-", $fakultasByApi[$i]->nm_lemb);
                    $fakultas->save();
                }
            }

            // dd('Data fakultas berhasil disingkron!');
        } catch (\Throwable $th) {
            dd($th);
            dd('Sinkronisasi gagal!');
        }

        $jenjang = [
            ['kode_prodi' => '86122', 'jenjang' => 'S2'], ['kode_prodi' => '46201', 'jenjang' => 'S1'], ['kode_prodi' => '61209', 'jenjang' => 'S1'],
            ['kode_prodi' => '60206', 'jenjang' => 'S1'], ['kode_prodi' => '13211', 'jenjang' => 'S1'], ['kode_prodi' => '74201', 'jenjang' => 'S1'],
            ['kode_prodi' => '14201', 'jenjang' => 'S1'], ['kode_prodi' => '15201', 'jenjang' => 'S1'], ['kode_prodi' => '13201', 'jenjang' => 'S1'],
            ['kode_prodi' => '94202', 'jenjang' => 'S1'], ['kode_prodi' => '88203', 'jenjang' => 'S1'], ['kode_prodi' => '86207', 'jenjang' => 'S1'],
            ['kode_prodi' => '86206', 'jenjang' => 'S1'], ['kode_prodi' => '85201', 'jenjang' => 'S1'], ['kode_prodi' => '84202', 'jenjang' => 'S1'],
            ['kode_prodi' => '61212', 'jenjang' => 'S1'], ['kode_prodi' => '54231', 'jenjang' => 'S1'], ['kode_prodi' => '26201', 'jenjang' => 'S1'],
            ['kode_prodi' => '55201', 'jenjang' => 'S1'], ['kode_prodi' => '22201', 'jenjang' => 'S1'], ['kode_prodi' => '15901', 'jenjang' => 'Profesi'],
            ['kode_prodi' => '86906', 'jenjang' => 'Profesi'], ['kode_prodi' => '14901', 'jenjang' => 'Profesi'], ['kode_prodi' => '15301', 'jenjang' => 'D4'],
            ['kode_prodi' => '15401', 'jenjang' => 'D3'], ['kode_prodi' => '14401', 'jenjang' => 'D3']
        ];
        // foreach ($jenjang as $JJN)
        // dd($JJN['kode_prodi']);

        // try {
        //     $responDataProdi = Http::withHeaders([
        //         'Authorization' => 'Bearer' . ' ' . $data->token,
        //         // 'Custom-Header' => 'Header-Value',
        //     ])->get('https://sains.universitaspahlawan.ac.id/api/prodi');

        //     $prodiByApi = json_decode($responDataProdi)->data;

        //     foreach ($jenjang as $JJN) {
        //         for ($i = 0; $i < count($prodiByApi); $i++) {
        //             $findProdi = Prodi::where('kode_prodi', $prodiByApi[$i]->id_sms)->first();
        //             // dd($prodiByApi[$i]->id_sms);
        //             if ($findProdi == null) {
        //                 if ($JJN['kode_prodi'] == $findProdi->kode) {
        //                     $prodi = new Prodi();
        //                     $prodi->kode_prodi = $prodiByApi[$i]->id_sms;
        //                     $prodi->fakultas_id = $findFakultas->id;
        //                     $prodi->nama_prodi = $prodiByApi[$i]->nm_lemb;
        //                     $prodi->slug = str_replace(" ", "-", $prodiByApi[$i]->nm_lemb);
        //                     $prodi->jenjang = $JJN['jenjang'];
        //                     $prodi->save();
        //                 }
        //             } else {
        //                 if ($JJN['kode_prodi'] == $findProdi->kode) {
        //                     $prodi = $findProdi;
        //                     $prodi->kode_prodi = $prodiByApi[$i]->id_sms;
        //                     $prodi->fakultas_id = $findFakultas->id;
        //                     $prodi->nama_prodi = $prodiByApi[$i]->nm_lemb;
        //                     $prodi->slug = str_replace(" ", "-", $prodiByApi[$i]->nm_lemb);
        //                     $prodi->jenjang = $JJN['jenjang'];
        //                     $prodi->save();
        //                 }
        //             }
        //         }
        //     }

        //     dd('Data berhasil disingkron!');
        // } catch (\Throwable $th) {
        //     dd($th);
        //     dd('Sinkronisasi gagal!');
        // }

        try {
            $responDataProdi = Http::withHeaders([
                'Authorization' => 'Bearer' . ' ' . $data->token,
                // 'Custom-Header' => 'Header-Value',
            ])->get('https://sains.universitaspahlawan.ac.id/api/prodi');

            $prodiByApi = json_decode($responDataProdi)->data;
            foreach ($jenjang as $JJN) {
                for ($i = 0; $i < count($prodiByApi); $i++) {
                    $findProdi = Prodi::where('kode_prodi', $prodiByApi[$i]->id_sms)->first();
                    $findFakultas = Fakultas::where('kode_fakultas', $prodiByApi[$i]->id_induk_sms)->first();
                    if ($findProdi == null) {
                        $prodi = new Prodi();
                        $prodi->kode_prodi = $prodiByApi[$i]->id_sms;
                        $prodi->fakultas_id = $findFakultas->id;
                        $prodi->nama_prodi = $prodiByApi[$i]->nm_lemb;
                        $prodi->slug = str_replace(" ", "-", $prodiByApi[$i]->nm_lemb);
                        $prodi->jenjang = $JJN['jenjang'];
                        $prodi->save();
                    } else {
                        if ($JJN['kode_prodi'] == $findProdi->kode_prodi) {
                            $prodi = $findProdi;
                            $prodi->kode_prodi = $prodiByApi[$i]->id_sms;
                            $prodi->fakultas_id = $findFakultas->id;
                            $prodi->nama_prodi = $prodiByApi[$i]->nm_lemb;
                            $prodi->slug = str_replace(" ", "-", $prodiByApi[$i]->nm_lemb);
                            $prodi->jenjang = $JJN['jenjang'];
                            $prodi->save();
                        }
                    }
                }
            }

            // dd('Data program studi berhasil disingkron!');
        } catch (\Throwable $th) {
            // dd($th);
            // dd('Sinkronisasi gagal!');
            throw $th;
        }
    }
}
