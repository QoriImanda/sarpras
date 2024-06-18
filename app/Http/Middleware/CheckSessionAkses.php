<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Prodi;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSessionAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd('testing');

        // $fakultas = Fakultas::where('user_id', auth()->user()->id);
        $prodi = Prodi::where('user_id', auth()->user()->id);


        $roleUser = [];
        $roles = json_decode(auth()->user()->roles);

        foreach ($roles as $role) {
            array_push($roleUser, $role->role_code);
        }

        // dd($roleUser);

        if ($prodi->count() > 1 && in_array('KPS', $roleUser)) {
            if (session('sessionAkses') != true) {
                return redirect()->route('auth.selectSessionAkses');
            }
            return $next($request);
        }

        return $next($request);
    }
}
