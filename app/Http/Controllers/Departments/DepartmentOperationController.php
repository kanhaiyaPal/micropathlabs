<?php

namespace App\Http\Controllers\Departments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Department;
use App\Signature;
use App\User;
use App\UserRoleModel;


class DepartmentOperationController extends Controller
{
    private $signature_permissions = array();
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');        
    }

    private function check_signature_roles()
    {
        $user_role = Auth::user()->role;

        $this->signature_permissions['view'] = UserRoleModel::where('view_module', 1)->where('role_name', $user_role )->where('module_name','signatures')->count();
        $this->signature_permissions['read'] = UserRoleModel::where('read_module', 1)->where('role_name', $user_role)->where('module_name','signatures')->count();
        $this->signature_permissions['write'] = UserRoleModel::where('write_module', 1)->where('role_name', $user_role)->where('module_name','signatures')->count();
        $this->signature_permissions['modify'] = UserRoleModel::where('modify_module', 1)->where('role_name', $user_role)->where('module_name','signatures')->count();
        $this->signature_permissions['delete'] = UserRoleModel::where('delete_module', 1)->where('role_name', $user_role)->where('module_name','signatures')->count();

        return $this->signature_permissions;
    }

    public function index()
    {
        $departments = Department::all();
        $sign_permission = $this->check_signature_roles();
        $signatures = Signature::all();
        return view('department.list',compact('departments','sign_permission','signatures'));
    }

    public function shownewdepartmentform()
    {
        $department = new Department;
        $sign_permission = $this->check_signature_roles();
        $signatures = Signature::all();
        return view('department.form',compact('department','sign_permission','signatures'));
    } 

    public function addnewdepartment(Request $request)
    {
        $department = new Department;

        $request->validate([            
         'username' => 'required|max:255|unique:users|bail',
         'password' => 'required|min:6|confirmed|bail',
         'email' => 'required|email|unique:users|bail',
         'name' => 'required|bail',
         'signature_id' => 'required',
        ]); 


        $new_user_id = User::insertGetId([
            'name' => $request->name,
            'username' => str_slug($request->username, '_'),
            'role' => 'departments',
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
       
        $department->user_id = $new_user_id;
        $department->signature_id = $request->signature_id;

        $department->save();

        $request->session()->flash('status', 'Successfully Added Department!');
        return redirect('departments');
    }      

    public function showdepartmenteditform(Department $department)
    {
        $sign_permission = $this->check_signature_roles();
        $signatures = Signature::all();
        return view('department.form',compact('department','sign_permission','signatures'));
    } 

    public function save_changes(Request $request,Department $department)
    {
        $request->validate([            
         'name' => 'required|max:255',
         'signature_id' => 'required',
        ]);

        $cur_user = User::where('id', $request->user_id)->first();

        if(!empty($request->new_password)){
            $request->validate([            
             'new_password' => 'required|min:6|confirmed|bail',
            ]);       
            $cur_user->password = Hash::make($request->pnew_assword);
            $cur_user->save();
        }

        if($cur_user->email!= $request->email){
            $request->validate([            
             'email' => 'required|email|unique:users|bail',
            ]); 
            $cur_user->email = $request->email;
            $cur_user->save();
        }

        if($cur_user->name!= $request->name){
            $cur_user->name = $request->name;
            $cur_user->save();
        }

        $department->signature_id = $request->signature_id;
        $department->save();

        $request->session()->flash('status', 'Successfully Modified Department!');
        return redirect('departments');
    }

    public function delete(Department $department)
    {
        $this->delete_item($department);
        \Session::flash('status', 'Successfully deleted the Department!');
        return redirect('departments');
    }

    public function deleteall(Request $request)
    {
        $items = explode(',',$request->fl_delete_all);
        if(count($items)>0){
            foreach ($items as $value) {
                $this->delete_item(Center::findOrFail($value));
            }
            \Session::flash('status', 'Successfully deleted the Departments!');
            return redirect('departments');
        }
    }

    private function delete_item(Department $department)
    {
        User::where('id',$department->user_id)->delete();
        $department->delete();
    }

}
