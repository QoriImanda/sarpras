<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class UserDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(UserDetail $userDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function updateFotoProfile(Request $request, $id)
    {
        $this->validate($request, [
            // check validtion for image or file
            'foto_profile' => 'required|image|mimes:jpg,png,jpeg|max:250',
        ]);

        $userDetail = UserDetail::where('user_id', $id)->first();
        if ($userDetail != null) {
            $fotoL = public_path('/storage/') . $userDetail->foto_profile;
            if (file_exists($fotoL)) {
                @unlink($fotoL);
            }

            $userDetail->foto_profile = $request->file('foto_profile')->store('foto-profile', 'public');
            $userDetail->save();

            return redirect()->back()->with('success', 'Foto profile berhasil diperbarui!');
        }

        return redirect()->back()->with('warning', 'Lengkapi data pribadi terlebih dahulu!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        if ($request->prodi_id == 'Pilih prodi!!') {
            return redirect()->back()->with('warning', 'Pilih prodi tidak boleh kosong!');
        }
        $checkRole = $this->cekRole();

        $user = User::find($id);
        // dd($request->all());
        if (in_array('MHS', $checkRole)) {

            // if ($user->userDetail == null) {
            //     $request->validate([
            //         'email' => ['required', 'string', 'max:255', 'unique:' . User::class],
            //     ]);
            // } else {
            //     if ($user->email != $request->email) {
            //         $request->validate([
            //             'email' => ['required', 'string', 'max:255', 'unique:' . User::class],
            //         ]);
            //     }
            // }

            // dd($user->userDetail);
            if ($user->userDetail == null) {
                $request->validate([
                    'nim' => 'required|unique:user_details',
                ]);
            } else {
                if ($user->userDetail->nim != $request->nim) {
                    $request->validate([
                        'nim' => 'required|unique:user_details',
                    ]);
                }
            }

            // $request->validate([
            //     'nama_lengkap' => 'required',
            //     'jk' => 'required',
            // ]);
        } elseif (in_array('DSN', $checkRole)) {

            // if ($user->userDetail == null) {
            //     $request->validate([
            //         'email' => ['required', 'string', 'max:255', 'unique:' . User::class],
            //     ]);
            // } else {
            //     if ($user->email != $request->email) {
            //         $request->validate([
            //             'email' => ['required', 'string', 'max:255', 'unique:' . User::class],
            //         ]);
            //     }
            // }

            if ($user->userDetail == null) {
                $request->validate([
                    'nidn' => 'required|unique:user_details',
                ]);
            } else {
                if ($user->userDetail->nidn != $request->nidn) {
                    $request->validate([
                        'nidn' => 'required|unique:user_details',
                    ]);
                }
            }

            // $request->validate([
            //     'nama_lengkap' => 'required',
            //     'jk' => 'required',
            // ]);
        } else {

            // if ($user->email != $request->email) {
            //     $request->validate([
            //         'email' => ['required', 'string', 'max:255', 'unique:' . User::class],
            //     ]);
            // }

            // if ($user->userDetail->nim != $request->nim) {
            //     $request->validate([
            //         'nim' => 'required|unique:user_details',
            //     ]);
            // }

            // if ($user->userDetail->nidn != $request->nidn) {
            //     $request->validate([
            //         'nidn' => 'required|unique:user_details',
            //     ]);
            // }

            // $request->validate([
            //     'nama_lengkap' => 'required',
            //     'jk' => 'required',
            // ]);
        }


        // dd($id);
        $user->email = $request->email;
        $user->save();

        if ($user->userDetail == null) {
            $userDetail = new UserDetail();
            $userDetail->user_id = $user->id;
            $userDetail->nama_lengkap = $request->input('nama_lengkap');
            $userDetail->jk = $request->input('jk');
            $userDetail->nidn = $request->input('nidn');
            $userDetail->nidn_string = $request->input('nidn');
            $userDetail->nim = $request->input('nim');
            $userDetail->nim_string = $request->input('nim');
            $userDetail->prodi_id = $request->input('prodi_id');
            $userDetail->save();
        } else {
            $userDetail = UserDetail::where('user_id', $user->id)->first();
            // dd($userDetail);
            //$userDetail->user_id = $user->id;
            $userDetail->nama_lengkap = $request->input('nama_lengkap');
            $userDetail->jk = $request->input('jk');
            $userDetail->nidn = $request->input('nidn');
            $userDetail->nidn_string = $request->input('nidn');
            $userDetail->nim = $request->input('nim');
            $userDetail->nim_string = $request->input('nim');
            $userDetail->prodi_id = $request->input('prodi_id');
            $userDetail->save();
            // $userDetail->update([
            //     'nama_lengkap' => $request->input('nama_lengkap'),
            //     'jk' => $request->input('jk'),
            //     'nidn' => $request->input('nidn'),
            //     'nim' => $request->input('nim'),
            //     'prodi_id' => $request->input('prodi_id')
            // ]);
            //dd($userDetail);
        }
        return redirect()->back()->with('success', 'Profile berhasil di-Update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserDetail $userDetail)
    {
        //
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
