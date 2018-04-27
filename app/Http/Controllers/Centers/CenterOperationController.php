<?php

namespace App\Http\Controllers\Centers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use App\Center;
use App\User;


class CenterOperationController extends Controller
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

    public function index()
    {
        $centers = Center::all();
        return view('center.list',compact('centers'));
    }

    public function shownewcenterform()
    {
        $center = new Center;
        return view('center.form',compact('center'));
    } 

    public function addnewcenter(Request $request)
    {
        $center = new Center;

        $request->validate([            
         'username' => 'required|max:255|unique:users|bail',
         'password' => 'required|min:6|confirmed|bail',
         'email' => 'required|email|unique:users|bail',
         'name' => 'required|bail',
         'code' => 'required|unique:center',
            'billing_cycle' => 'required',
            'advance' => 'nullable|numeric',                       
            'sales_officer' => 'required' 
        ]); 

        $find_user =  User::where('username', $request->username)->first();
        $new_user_id = '';
        if(empty($find_user)){
            $new_user_id = User::insertGetId([
                'name' => $request->name,
                'username' => str_slug($request->username, '_'),
                'role' => 'center',
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
        }else{
            $new_user_id = $find_user->id;
        }
        

        $this->edit_center($center,$request,$new_user_id);

        $request->session()->flash('status', 'Successfully Added Center!');
        return redirect('centeres');
    }  

    private function edit_center(Center $center,Request $request,$user_id)
    {
        //$this->validate_form($request);    

        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'billing_cycle' => 'required',
            'advance' => 'nullable|numeric',                       
            'sales_officer' => 'required'            
        ]);

        $center->code = $request->code;
        $center->name = $request->name;
        $center->address = $request->address;
        $center->role = $request->role;
        $center->division = $request->division;
        $center->psc = $request->psc;
        $center->lab = $request->lab;
        $center->advance = $request->advance;
        $center->billing_cycle  = $request->billing_cycle;
        $center->sales_officer  = $request->sales_officer;
        $center->user_id  = $user_id;       
        $center->save();
    }

    public function showcentereditform(Center $center)
    {
        return view('center.form',compact('center'));
    } 

    public function saveexistingcenter(Request $request,Center $center)
    {
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

        $request->validate([
            'name' => 'required'           
        ]);

        if($cur_user->name!= $request->name){
            $cur_user->name = $request->name;
            $cur_user->save();
        }

        $this->edit_center($center,$request,$request->user_id);

        $request->session()->flash('status', 'Successfully Modified Center!');
        return redirect('centeres');
    }

    public function deletecenter(Center $center)
    {
        $this->delete_item($center);
        \Session::flash('status', 'Successfully deleted the Center!');
        return redirect('centeres');
    }

    public function deleteall(Request $request)
    {
        $items = explode(',',$request->fl_delete_all);
        if(count($items)>0){
            foreach ($items as $value) {
                $this->delete_item(Center::findOrFail($value));
            }
            \Session::flash('status', 'Successfully deleted the Centers!');
            return redirect('centeres');
        }
    }

    private function delete_item(Center $center)
    {
        User::where('id',$center->user_id)->delete();
        $center->delete();
    }

}
