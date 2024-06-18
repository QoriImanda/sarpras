<?php

namespace App\Http\Controllers\Monev;

use Carbon\Carbon;
use App\Models\Sarana;
use App\Models\Prasarana;
use App\Models\TahunPeriode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MonevController extends Controller
{
    public function index()
    {
        $thn = request('thn') ?? Carbon::now()->format('Y');
        $prasarana = Prasarana::OrderBy('nama_prasarana', 'asc')->get();
        $sarana = Sarana::OrderBy('nama_sarana', 'asc')->get();

        return view('page.monev.index', [
            'prasaranas' => $prasarana,
            'saranas' => $sarana,
            'thnPeriode' => TahunPeriode::orderBy('thn', 'desc')->get(),
            'thn' => $thn,
            'semester' => request('semester') ?? 'Ganjil'
        ]);
    }
}
