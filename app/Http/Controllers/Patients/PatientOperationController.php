<?php

namespace App\Http\Controllers\Patients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Patient;
use App\Center;


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

    public function index()
    {
        return "Patient Index";
    }

    public function showpatientregisterform()
    {
        $patient = new Patient;
        $centers = Center::all();
        return view('patients.form',compact('patient','centers'));
    } 

    public function createnewpatient(Request $request)
    {
        $patient = new Patient;
        $this->edit_patient($patient,$request);
    }  

    private function edit_patient(Patient $patient,Request $request)
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
        $centers = Center::all();
        return view('patients.form',compact('patient','centers'));
    } 

    public function saveexistingpatient(Request $request,Patient $patient)
    {
        $this->edit_patient($patient,$request);
    }

    private function delete_individual(Patient $patient)
    {
        $patient->delete();
    }

}
