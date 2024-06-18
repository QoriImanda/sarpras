<?php

namespace App\Http\Controllers\PemeliharaanSarpras;

use Carbon\Carbon;
use App\Models\Sarana;
use App\Models\Prasarana;
use App\Models\TahunPeriode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LogPemeliharaanSarpras;
use App\Models\PenanggungJawabSarpras;

class PemeliharaanSarprasController extends Controller
{
    public function index()
    {
        $userRole = $this->cekRole();
        $thn = request('thn') ?? Carbon::now()->format('Y');

        if (in_array('PJS', $userRole)) {

            $pjSarpras = PenanggungJawabSarpras::where('user_id', auth()->user()->id)->select('id', 'user_id', 'sarpras_id', 'sarana_or_prasarana')->get();
            $prasaranaSarana = Sarana::join('prasarana_sarana', 'saranas.id', '=', 'prasarana_sarana.sarana_id')
            ->join('prasaranas', 'prasarana_sarana.prasarana_id', '=', 'prasaranas.id')
            ->join('penanggung_jawab_sarpras', 'prasaranas.id', '=', 'penanggung_jawab_sarpras.sarpras_id')
            ->join('user_details', 'penanggung_jawab_sarpras.user_id', '=', 'user_details.user_id')
            ->where('penanggung_jawab_sarpras.user_id', auth()->user()->id)->select(
                'saranas.id',
                'saranas.kode_inventaris',
                'saranas.nama_sarana',
                'saranas.desc',
                'saranas.jenis_sarana',
                'saranas.kategori_id',
                'saranas.tahun_pengadaan',
                'saranas.jumlah',
                'saranas.lokasi_sarana',
                'saranas.status',
                )->get();

            // dd($pjSarpras);
            return view('page.pemeliharaanSarpras.index', [
                'pjSarpras' => $pjSarpras,
                'prasaranaSaranas' => $prasaranaSarana,
                'thnPeriode' => TahunPeriode::orderBy('thn', 'desc')->get(),
                'thn' => $thn,
                'semester' => request('semester') ?? 'Ganjil'
            ]);
        } elseif (in_array('ADM', $userRole) || in_array('IVN', $userRole) ) {
            $prasarana = Prasarana::OrderBy('nama_prasarana', 'asc')->get();
            $sarana = Sarana::OrderBy('nama_sarana', 'asc')->get();

            return view('page.pemeliharaanSarpras.index', [
                'prasaranas' => $prasarana,
                'saranas' => $sarana,
                'thnPeriode' => TahunPeriode::orderBy('thn', 'desc')->get(),
                'thn' => $thn,
                'semester' => request('semester') ?? 'Ganjil'
            ]);
        }
    }

    public function post(Request $request)
    {
        // dd($request->all());

        $logPemeliharaanSarpras = LogPemeliharaanSarpras::where('sarpras_id', $request->sarpras_id)->where('tahun_periode', $request->tahun_periode)
            ->where('sarana_or_prasarana', $request->sarana_or_prasarana)->where('semester', $request->semester)->first();
        // dd($logPemeliharaanSarpras);
        if ($logPemeliharaanSarpras) {
            $logPemeliharaanSarpras->update($request->all());
        } else {
            LogPemeliharaanSarpras::create($request->all());
        }

        return redirect()->back();
    }

    public function cekRole($roleData = null)
    {
        if (is_null($roleData)) {
            $roles = auth()->user()->roles;
        } else {
            $roles = $roleData;
        }

        $listRole = [];
        foreach ($roles as $role) {
            array_push($listRole, $role->role_code);
        }

        return $listRole;
    }
}
