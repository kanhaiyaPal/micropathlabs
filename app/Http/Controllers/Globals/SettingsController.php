<?php

namespace App\Http\Controllers\Globals;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\UserRoleModel;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventory = UserRoleModel::where('role_name','inventory')->get();
        $accounts = UserRoleModel::where('role_name','account')->get();
        $departments = UserRoleModel::where('role_name','department')->get();
        $centers = UserRoleModel::where('role_name','center')->get();
        $doctors = UserRoleModel::where('role_name','doctor')->get();

        $roles_data = array(
            'inventory' => $inventory,
            'account' => $accounts,
            'department' => $departments,
            'center' => $centers,
            'doctor' => $doctors,
        );

        return view('globals.index',compact('roles_data'));
    }

    public function save(Request $request)
    {
        
        $all_permissions = UserRoleModel::all();

        foreach ($all_permissions as $pkey => $pvalue) {
            if($pvalue->role_name!='admin')
            {
                $q_index = $pvalue->module_name.'_'.$pvalue->role_name.'_read';
                if($request->$q_index == '1'){
                    UserRoleModel::where('module_name', $pvalue->module_name)->where('role_name', $pvalue->role_name)->update(['read_module' => 1]);
                }else{
                    UserRoleModel::where('module_name', $pvalue->module_name)->where('role_name', $pvalue->role_name)->update(['read_module' => 0]);
                }

                $q_index = $pvalue->module_name.'_'.$pvalue->role_name.'_write';
                if($request->$q_index == '1'){
                    UserRoleModel::where('module_name', $pvalue->module_name)->where('role_name', $pvalue->role_name)->update(['write_module' => 1]);
                }else{
                    UserRoleModel::where('module_name', $pvalue->module_name)->where('role_name', $pvalue->role_name)->update(['write_module' => 0]);
                }

                $q_index = $pvalue->module_name.'_'.$pvalue->role_name.'_modify';
                if($request->$q_index == '1'){
                    UserRoleModel::where('module_name', $pvalue->module_name)->where('role_name', $pvalue->role_name)->update(['modify_module' => 1]);
                }else{
                    UserRoleModel::where('module_name', $pvalue->module_name)->where('role_name', $pvalue->role_name)->update(['modify_module' => 0]);
                }

                $q_index = $pvalue->module_name.'_'.$pvalue->role_name.'_delete';
                if($request->$q_index == '1'){
                    UserRoleModel::where('module_name', $pvalue->module_name)->where('role_name', $pvalue->role_name)->update(['delete_module' => 1]);
                }else{
                    UserRoleModel::where('module_name', $pvalue->module_name)->where('role_name', $pvalue->role_name)->update(['delete_module' => 0]);
                }

                $q_index = $pvalue->module_name.'_'.$pvalue->role_name.'_view';
                if($request->$q_index == '1'){
                    UserRoleModel::where('module_name', $pvalue->module_name)->where('role_name', $pvalue->role_name)->update(['view_module' => 1]);
                }else{
                    UserRoleModel::where('module_name', $pvalue->module_name)->where('role_name', $pvalue->role_name)->update(['view_module' => 0]);
                }
            }
        }

        \Session::flash('status', 'Successfully updated the permissions!');
        return redirect('globalsettings');     
        
    }
}
