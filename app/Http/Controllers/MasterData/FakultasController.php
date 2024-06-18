<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Fakultas;
use App\Models\UserDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FakultasController extends Controller
{
    public function index()
    {
        $fakultas = Fakultas::orderBy('nama_fakultas', 'asc')->get();
        $user = UserDetail::orderBy('nama_lengkap', 'asc')
        ->join('role_user', 'role_user.user_id', '=', 'user_details.user_id')
        ->join('roles','roles.id','=','role_user.role_id')
        ->where('role_code', 'DFS')->get();
        // dd($user);
        return view('masterData.fakultas.index', [
            'sideBarActive' => 'true',
            'fakultases' => $fakultas,
            'dekans' => $user
        ]);
    }

    public function updateDekan(Request $request, $id)
    {
        // dd($request->all());

        if($request->user_id == 'Pilih Dekan!!'){
            return redirect()->back()->with('warning', 'Form tidak boleh kosong!');
        }else{
            $fakultas = Fakultas::find($id);
            $fakultas->nama_fakultas = $request->nama_fakultas;
            $fakultas->slug = Str::slug($request->nama_fakultas);
            $fakultas->user_id = $request->user_id;
            $fakultas->save();
        }

        return redirect()->back()->with('success', 'Dekan fakultas'.' '.$fakultas->nama_fakultas.' '.'berhasil dipilih!');
    }
}
