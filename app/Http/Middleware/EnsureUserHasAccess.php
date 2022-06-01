<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use DB;
use App\Models\User;

class EnsureUserHasAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $access_menu = null)
    {
        
        if( auth()->user()->id ) {
            
            $info = User::find(auth()->id());
            if( auth()->user()->is_super_admin ) {

            } else {
                $module = $request->route()->getName(); 
            
                check_access($info->role->permissions, $module, $access_menu);
            }
            
        }
        return $next($request);
    }
}
