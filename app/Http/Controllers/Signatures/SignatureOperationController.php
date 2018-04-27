<?php

namespace App\Http\Controllers\Signatures;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;


use App\Signature;

class SignatureOperationController extends Controller
{
    private $signature_path = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');   
        $this->signature_path = public_path('/uploads/signatures');   
    }  

    public function shownewsignatureform()
    {
        $signature = new Signature;
        $path = $this->signature_path;        
        return view('signature.form',compact('signature','path'));
    } 

    public function addnewsignature(Request $request)
    {
        $signature = new Signature;

        $request->validate([            
         'signatory_name' => 'required|max:255',
         'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]); 

        $catimageName = '';

        $name = bin2hex(random_bytes(32));
        $catimageName = $name.'.'.request()->image->getClientOriginalExtension();
        request()->image->move($this->signature_path, $catimageName);

        $signature->name = $request->signatory_name;
        $signature->image = $catimageName;
        $signature->save();
        
        $request->session()->flash('status', 'Successfully Added Signature!');
        return redirect('departments');
    }  

    Public function save_changes(Signature $signature,Request $request)
    {
        //$this->validate_form($request);    

         $request->validate([            
         'signatory_name' => 'required|max:255',
         'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]); 

        $catimageName = '';

        if(isset($request->image)){
            $name = bin2hex(random_bytes(32));
            $catimageName = $name.'.'.request()->image->getClientOriginalExtension();
            request()->image->move($this->signature_path, $catimageName);
        }else{
            $catimageName = $request->old_image;
        }

        $signature->name = $request->signatory_name;
        $signature->image = $catimageName;
        $signature->save();
        
        $request->session()->flash('status', 'Successfully Modified Signature!');
        return redirect('departments');
    }

    public function editform(Signature $signature)
    {
        $path = $this->signature_path; 
        return view('signature.form',compact('signature','path'));
    }     

    public function delete(Signature $signature)
    {
        $this->delete_item($signature);
        \Session::flash('status', 'Successfully deleted the Signature!');
        return redirect('departments');
    }

    public function deleteall(Request $request)
    {
        $items = explode(',',$request->fl_delete_all);
        if(count($items)>0){
            foreach ($items as $value) {
                $this->delete_item(Signature::findOrFail($value));
            }
            \Session::flash('status', 'Successfully deleted the Signatures!');
            return redirect('departments');
        }
    }

    private function delete_item(Signature $signature)
    {
        File::delete($this->signature_path.'/'.$signature->image);
        $signature->delete();
    }

}
