<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Role;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $user = User::latest()->get();
        // dd($user);
        return view('users.index', [
            'sideBarActive' => 'true',
            'users' => $user
        ]);
    }

    public function edit($id = null)
    {
        // edit dari admin

        if ($id == null) {
            $user = User::findorfail(auth()->user()->id);
        } else {
            $user = User::findorfail($id);
        }
        $roles = $user->roles;
        $roleUser = [];
        foreach ($roles as $role) {
            array_push($roleUser, $role->role_code);
        }
        // dd($roleUser);

        // End edit dari admin

        $checkRole = $this->cekRole();
        $prodis = Prodi::all();
        $roles = Role::all();
        $userDetail = UserDetail::find($user->id);
        // dd($checkRole);
        return view('users.edit', [
            'redirect' => 'edit',
            'prodis' => $prodis,
            'user' => $user,
            'userDetail' => $userDetail,
            'checkRole' => $checkRole,
            'roles' => $roles,
            'sideBarActive' => 'active',
            'roleUser' => $roleUser
        ]);
    }

    public function changeRole(Request $request, $id)
    {
        $user = User::find($id);
        $user->roles()->sync($request->role_id);

        return redirect()->back()->with('success', 'Role user berhasil diperbarui!');
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

    public function changeAccount(Request $request, $id)
    {
        $user = User::find($id);

        $checkRole = $this->cekRole();

        if (in_array('ADM', $checkRole)) {
            $user = User::find($id);
            $user->username = $request->username;
            $user->password = Hash::make($request->input('newpassword'));
            $user->update();

            return redirect()->back()->with('success', 'Account berhasil diubah!');
        }

        if (Hash::check($request->password, $user->password) && $request->renewpassword == $request->newpassword) {

            $user = User::find($id);
            $user->username = $request->username;
            $user->password = Hash::make($request->input('newpassword'));
            $user->update();

            return redirect()->back()->with('success', 'Account berhasil diubah!');
        } else {

            return redirect()->back()->with('warning', 'Password yang anda masukkan salah...');
        }
    }

    // public function testDataUser()
    // {
    //     $user = new User();

    //     $dataUser = [];
    //     $dataUser['nama'] = 'Qori Imanda';
    //     $dataUser['nim'] = '88888888';
    //     $dataUser['semester'] = '8';
    //     $dataUser['tahun_tamat'] = '2023';
    //     $dataUser['alamat'] = 'Jl. K.H Agussalim, Bangkinang Kota';

    //     $user->name = 'qori';
    //     $user->email = 'imandaqori@gmail.com';
    //     $user->password = '12345678';
    //     $user->save();

    //     $userDetail = new UserDetail();
    //     $userDetail->user_id = $user->id;
    //     $userDetail->data_user = json_encode($dataUser);
    //     $userDetail->save();

    // }

    // public function viewTestingUser()
    // {
    //     $user = UserDetail::findorfail(1);
    //     $data_user = json_decode($user->data_user);
    //     $data_user = [];
    //     $data_user['nama'] = '';
    //     $data_user['nim'] = '';
    //     $data_user['semester'] = '';
    //     $data_user['tahun_tamat'] = '';
    //     $data_user['alamat'] = '';

    //     dd($data_user);
    //     // $user = UserDetail::all();

    //     // return view('welcome', [
    //     //     'user' => $user
    //     // ]);
    // }
}
