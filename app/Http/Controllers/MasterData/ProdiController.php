<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Prodi;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdiController extends Controller
{
    public function index()
    {
        $prodi = Prodi::orderBy('nama_prodi', 'asc')->get();
		 $user = UserDetail::orderBy('nama_lengkap', 'asc')
        ->join('role_user', 'role_user.user_id', '=', 'user_details.user_id')
        ->join('roles','roles.id','=','role_user.role_id')
        ->where('role_code', 'KPS')->get();
         //dd($user);
        return view('masterData.prodi.index', [
            'sideBarActive' => 'true',
            'prodis' => $prodi,
			'kaprodi' => $user
        ]);
    }

	public function updateKaprodi(Request $request, $id)
    {
        // dd($request->all());

        if($request->user_id == 'Pilih Kaprodi!!'){
            return redirect()->back()->with('warning', 'Form tidak boleh kosong!');
        }else{
            $prodi = Prodi::find($id);
            $prodi->user_id = $request->user_id;
            $prodi->save();
        }

        return redirect()->back()->with('success', 'Ketua'.' '.$prodi->nama_prodi.' '.'berhasil dipilih!');
    }
}
