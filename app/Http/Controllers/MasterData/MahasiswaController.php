<?php

namespace App\Http\Controllers\MasterData;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = User::join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->join('user_details', 'user_details.user_id', '=', 'users.id')
            ->join('prodis', 'prodis.id', '=', 'user_details.prodi_id')
            ->where('role_code', 'MHS')->orderBy('nim', 'desc')->get();
        // dd($mahasiswa);
        return view('masterData.mahasiswa.index', [
            'sideBarActive' => 'true',
            'mahasiswas' => $mahasiswa
        ]);
    }
}
