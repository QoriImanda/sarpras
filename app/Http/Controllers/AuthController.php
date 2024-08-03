<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Prodi;
use App\Models\Fakultas;
use App\Models\Role_user;
use Illuminate\View\View;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Faker\Provider\UserAgent;
use Illuminate\Validation\Rules;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class AuthController extends Controller
{

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        $role = Role::whereNotIn('role_name', [
            'Admin',
            'Dekan Fakultas',
            'Ketua Program Studi',
            'Sekretaris Program Studi',
            'Koordinator KTI Fakultas',
            'Koordinator Sekretaris KTI Fakultas',
            'Koordinator Sekretaris KTI Prodi',
            'Koordinator KTI Prodi',
            'Rektor',
            // 'Lembaga Penjaminan Mutu',
            // 'Inventaris'
            // 'Tendik'
        ])->get();

        return view('auth.register', [
            'role' => $role
        ]);
    }

    public function post(Request $request)
    {
        $cre = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // session([
        //     'username' => $request->username,
        //     'password' => $request->password
        // ]);

        // dd(session()->all());

        $checkedUser = User::where('username', $request->username)->first();

        if (Auth::attempt($cre)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        } else {
            return back()->with('gagal', 'Login failed!..., Periksa usename dan password dengan benar...');
        }
        // dd($dataLogin);

    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            // 'email' => ['max:255', 'unique:' . User::class],
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->roles()->attach($request['role_id']);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->forget([
            'username',
            'role_akses'
        ]);
        return redirect('/auth/login');
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
