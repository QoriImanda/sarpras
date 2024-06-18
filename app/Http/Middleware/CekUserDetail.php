<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekUserDetail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $roleUser = [];
        $roles = auth()->user()->roles;
        foreach ($roles as $role) {
            array_push($roleUser, $role->role_code);
        }

        $user = User::with(['userDetail'])->find(auth()->user()->id);
        // dd($user->userDetail);
        // dd($roleUser);
        // if (!in_array('REK', $roleUser)) {
        //     if (!(in_array('ADM', $roleUser) )) {
                if ($user->userDetail == null) {
                    return redirect()->route('user.edit', auth()->user()->id)
                        ->with('info', 'Lengkapi data pribadi terlebih dahulu dengan pilih menu edit profile!');
                }
                // elseif ($user->userDetail->prodi_id == null) {
                //     return redirect()->route('user.edit', auth()->user()->id)
                //         ->with('info', 'Lengkapi data pribadi terlebih dahulu dengan pilih menu edit profile!');
                // }
            // } elseif (in_array('ADM', $roleUser)) {
                if ($user->userDetail == null) {
                    return redirect()->route('user.edit', auth()->user()->id)
                        ->with('info', 'Lengkapi data pribadi terlebih dahulu dengan pilih menu edit profile!');
                }
            // }
        // }

        return $next($request);
    }
}
