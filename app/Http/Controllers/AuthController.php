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

        if ($checkedUser == null) {
            $userLoginAPI = $this->loginAPI($request->username, $request->password);
            $dataLogin = json_decode($userLoginAPI);
            if ($dataLogin->isSuccess ?? '' == 200) {
                $userAPI = $this->userAPI($dataLogin);

                // dd($userAPI->data);
                $user = User::create([
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'secret' => $request->password
                ]);

                $role = Role::get();

                if ($dataLogin->role == 'mahasiswa') {
                    $cariKodeProdi = $userAPI->data->nim;
                    $kodeProdi = substr($cariKodeProdi, 2, 5);
                    // dd($kodeProdi);
                    $prodi = Prodi::where('kode_prodi', $kodeProdi)->first();
                    // dd($prodi);
                    $userDetail = UserDetail::create([
                        'user_id' => $user->id,
                        'nama_lengkap' => $userAPI->data->nama,
                        'nim' => $userAPI->data->nim,
                        'nim_string' => $userAPI->data->nim,
                        'prodi_id' => $prodi->id
                    ]);
                    $roleUser = $role->where('role_code', 'MHS')->first();
                    $user->roles()->attach($roleUser->id);
                } elseif ($dataLogin->role == 'dosen') {
                    // $cariKodeProdi = $userAPI->data->nidn;
                    // $kodeProdi = substr($cariKodeProdi, 2, 5);
                    // dd($kodeProdi);
                    // $prodi = Prodi::where('kode_prodi', $kodeProdi)->first();
                    $userDetail = UserDetail::create([
                        'user_id' => $user->id,
                        'nama_lengkap' => $userAPI->data->nama,
                        'nidn' => $userAPI->data->nidn,
                        'nidn_string' => $userAPI->data->nidn
                    ]);
                    $roleUser = $role->where('role_code', 'DSN')->first();
                    $user->roles()->attach($roleUser->id);
                }

                if (Auth::attempt($cre)) {
                    $request->session()->regenerate();
                    return redirect()->intended('/');
                }
            } else {
                return back()->with('gagal', 'Login failed!..., Periksa usename dan password dengan benar...');
            }
            // dd($dataLogin);
        } else {
            if (Auth::attempt($cre)) {
                $user = User::where('username', $request->username)->first()->update(['secret' => $request->password]);
                $userCheck = User::where('username', $request->username)->first();
                $userDetailCheck = UserDetail::where('user_id', $userCheck->id)->first();
                $checkRole = $this->cekRole();
                if (!in_array('ADM', $checkRole)) {
                    if ($userDetailCheck->nidn_string == null || $userDetailCheck->nim_string == null) {
                        $userLoginAPI = $this->loginAPI($request->username, $request->password);
                        $dataLogin = json_decode($userLoginAPI);
                        if ($dataLogin->isSuccess ?? '' == 200) {
                            $userAPI = $this->userAPI($dataLogin);
                            $userDetailCheck->update([
                                'nim_string' => $userAPI->data->nim ?? null,
                                'nidn_string' => $userAPI->data->nidn ?? null,
                            ]);
                        }
                    }
                }
                // dd($user);
                $request->session()->regenerate();
                return redirect()->intended('/');
            } else {
                $userLoginAPI = $this->loginAPI($request->username, $request->password);
                $dataLogin = json_decode($userLoginAPI);
                if ($dataLogin->isSuccess ?? '' == 200) {
                    $user = User::where('username', $request->username)->first();
                    $user->password = Hash::make($request->password);
                    $user->secret = $request->password;
                    $user->save();
                    if (Auth::attempt($cre)) {
                        $userDetailCheck = UserDetail::where('user_id', $user->id)->first();
                        if ($userDetailCheck->nidn_string == null || $userDetailCheck->nim_string == null) {
                            $userAPI = $this->userAPI($dataLogin);
                            $userDetailCheck->update([
                                'nim_string' => $userAPI->data->nim ?? null,
                                'nidn_string' => $userAPI->data->nidn ?? null,
                            ]);
                        }
                        $request->session()->regenerate();
                        return redirect()->intended('/');
                    }
                } else {
                    return back()->with('gagal', 'Login failed!..., Periksa usename dan password dengan benar...');
                }
            }
        }
    }

    public function loginAPI($username, $password)
    {
        try {
            $response = Http::withHeaders([
                // 'Authorization' => 'Bearer your_access_token',
                // 'Custom-Header' => 'Header-Value',
            ])
                ->post('https://sains.universitaspahlawan.ac.id/api/login', [
                    'username' => $username,
                    'password' => $password
                ]);
            return $response;
        } catch (\Throwable $th) {
            return abort(503);
        }
    }

    public function userAPI($data)
    {
        // dd($data);
        if ($data->role == 'mahasiswa') {
            $responseUserDetail = Http::withHeaders([
                'Authorization' => 'Bearer' . ' ' . $data->token,
                // 'Custom-Header' => 'Header-Value',
            ])->get('https://sains.universitaspahlawan.ac.id/api/mahasiswa?username=' . $data->username);
            return json_decode($responseUserDetail);
        } elseif ($data->role == 'dosen') {
            $responseUserDetail = Http::withHeaders([
                'Authorization' => 'Bearer' . ' ' . $data->token,
                // 'Custom-Header' => 'Header-Value',
            ])->get('https://sains.universitaspahlawan.ac.id/api/dosen?username=' . $data->username);
            return json_decode($responseUserDetail);
        }
    }

    public function selectSessionAkses()
    {
        $fakultas = Fakultas::where('user_id', auth()->user()->id)->get();
        $prodi = Prodi::where('user_id', auth()->user()->id)->get();

        return view('auth.pilih-session-akses', [
            'fakultases' => $fakultas,
            'prodis' => $prodi
        ]);
    }

    public function selectedSessionAkses($selected)
    {
        session([
            'sessionAkses' => true,
            'selected' => $selected,
        ]);

        return redirect()->route('dashboard.index');
    }

    // public function store(Request $request)
    // {
    //     dd($request->all());
    //     // $dataUser->roles()->sync($request->role);
    // }

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
