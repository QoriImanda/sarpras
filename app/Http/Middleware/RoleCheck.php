<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\PenugasanKTI;
use Illuminate\Http\Request;
use App\Models\RekapTahunPeriode;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $access)
    {
        $access = explode('|', $access);
        // dd($access);
        $roles = json_decode($request->user()->roles);
        $thisRoleCode = [];

        foreach ($roles as $key => $role) {
            array_push($thisRoleCode, $role->role_code);
        }

        $allow = array_intersect($access, $thisRoleCode) ? true : false;

        if (!$allow) {
            return abort(403);
        }

        return $next($request);
    }
}
