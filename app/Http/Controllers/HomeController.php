<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class HomeController extends Controller
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
        return view('home');
    }

    public function nopermission()
    {
        return view('errors.nopermission');
    }

    public function changeadmincredentials(Request $request)
    {
        $validatedData = $request->validate([
            'admin_email' => 'required',
            'current_password' => 'required',
            'new_password' => 'required|string|min:6',
            'confirm_password' => 'required|string|min:6|same:new_password',
        ]);

        if (!(Hash::check($request->current_password, $request->user()->password))) {
            // The passwords matches
            $request->session()->flash('status', 'Current Password Incorrect');
            return redirect(url()->previous());
        }           
 
        //Change Password
        $user = $request->user();
        $user->password = bcrypt($request->new_password);
        $user->email = $request->admin_email;
        $user->save();

        $request->session()->flash('status', 'Successfully Modified Admin Details!');
        return redirect('globalsettings');
    }
}
