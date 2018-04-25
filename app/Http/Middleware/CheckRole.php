<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use App\UserRoleModel;


use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$action = 'read',$module_name = '')
    {
        $user = \Auth::user($request->id);
        $count_role = UserRoleModel::where('module_name',$module_name)->where('role_name',$user->role)->where($action.'_module','1')->count();
        if($count_role<=0){
            return redirect('nopermission');
        }

        return $next($request);
    }
}
