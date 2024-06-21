<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CetakPDFController extends Controller
{
    public function cetakPdf($tahun, $semester)
    {
        

        if ($jdwlSidng && $mhsBimbingan && $ketuaDewanPenguji && $sekretaris && $penguji1 && $penguji2 && $koordinatorKTI && $judulTA) {
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [216, 330]]);
            $html = view('cetak-laporan', compact(
                'jdwlSidng',
                'mhsBimbingan',
                'ketuaDewanPenguji',
                'sekretaris',
                'penguji1',
                'penguji2',
                'koordinatorKTI',
                'judulTA',
                'nama_fakultas',
                'fakultas',
                'waktuSkrng',
                'bulan',
                'tahun',
                'nomor_surat',
            ))->render();

            $mpdf->WriteHTML($html);
            $mpdf->Output();
        } else {
            // Handle ketika query tidak mengembalikan hasil yang diharapkan
            // Misalnya, tampilkan pesan error atau lakukan tindakan lain sesuai kebutuhan aplikasi.
        }
    }
}
