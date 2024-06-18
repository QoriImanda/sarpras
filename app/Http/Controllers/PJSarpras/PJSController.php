<?php

namespace App\Http\Controllers\PJSarpras;

use App\Http\Controllers\Controller;
use App\Models\PenanggungJawabSarpras;
use App\Models\Prasarana;
use App\Models\Sarana;
use Illuminate\Http\Request;

class PJSController extends Controller
{
    public function index()
    {
        $prasarana = Prasarana::OrderBy('nama_prasarana', 'asc')->get();
        $sarana = Sarana::OrderBy('nama_sarana', 'asc')->get();

        return view('page.penanggungJawabSarpras.index', [
            'prasaranas' => $prasarana,
            'saranas' => $sarana
        ]);
    }

    public function post(Request $request, $sarpras_id)
    {
        $find = PenanggungJawabSarpras::where('sarpras_id', $sarpras_id)
        ->where('sarana_or_prasarana', $request->sarpras)->first();
        // dd($find);
        if ($find == null) {
            PenanggungJawabSarpras::create([
                'user_id' => $request->user_id,
                'sarpras_id' => $sarpras_id,
                'sarana_or_prasarana' => $request->sarpras
            ]);
        }else{
            $find->update([
                'user_id' => $request->user_id,
            ]);
        }

        return redirect()->back();
    }
}
