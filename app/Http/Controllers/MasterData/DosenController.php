<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $dosen = User::join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->join('user_details', 'user_details.user_id', '=', 'users.id')
            ->leftJoin('prodis', 'prodis.id', '=', 'user_details.prodi_id')
            ->where('roles.role_code', 'DSN')
            ->orderBy('nama_prodi', 'asc')->get();
        // dd($dosen);
        return view('masterData.dosen.index', [
            'sideBarActive' => 'true',
            'dosens' => $dosen
        ]);
    }
}
