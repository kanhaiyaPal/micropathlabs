<?php

namespace App\Http\Controllers\Patients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Patient;
use App\CenterModel;


class PatientOperationController extends Controller
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

    public function showpatientregisterform()
    {
        $patient = new Patient;
        $centers = CenterModel::all();
        return view('patients.form',compact('patient','centers'));
    } 

    public function createnewpatient(Request $request)
    {
        //Validate
        $request->validate([
            'center_id' => 'required',
            'doctor_name' => 'required',
            'salutation' => 'required',
            'name' => 'required',
            'age' => 'required|numeric|between:0,200',
            'gender' => 'required',
            'mobile' => 'required|numeric|digits:10', 
            'vial_ids' => 'required',
            'tests' => 'required'
        ]);

        $patient = new Patient;
        $patient->doctor_name = $request->doctor_name;
        $patient->salutation = $request->salutation;
        $patient->name = $request->name;
        $patient->gender = $request->gender;
        $patient->age = $request->age;
        $patient->vial_id = $request->vial_ids;
        $patient->mobile = $request->mobile;
        $patient->medical_history = $request->medical_history;
        $patient->center_id = $request->center_id;
        $patient->registration_no = date("ymd");
        $patient->save();

    }  

    public function showpatienteditform(Patient $patient)
    {
        return view('patients.form');
    } 

    public function saveexistingpatient(Request $request,Patient $patient)
    {

    }
}
