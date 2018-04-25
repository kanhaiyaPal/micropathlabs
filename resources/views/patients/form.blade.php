@extends('layouts.dashboard')

@section('resources')
<!-- icheck Plugin JavaScript -->
    <script src="{{ asset('plugins/bower_components/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/icheck/icheck.init.js') }}"></script>
    <link href="{{ asset('plugins/bower_components/icheck/skins/all.css') }}" rel="stylesheet">
<!-- multi select Plugin JavaScript -->
    <script type="text/javascript" src="{{ asset('plugins/bower_components/multiselect/js/jquery.multi-select.js') }}"></script>
    <link href="{{ asset('plugins/bower_components/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
<!-- tags input Plugin JavaScript -->    
    <link href="{{ asset('plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
    <script src="{{ asset('plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script>
    $(document).ready(function() {
        $('#pre-selected-options').multiSelect();        
    });
    </script>    
@endsection

@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
            	@if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Register New Patient</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="active">New Registration</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- .row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Add New Patient</h3>
                            <p class="text-muted m-b-30 font-13">Patient Registration - Sample Registration Form</p>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    @if(isset($patient->id))
                                        <form class="floating-labels" action="{{url('patient', [$patient->id])}}" method="POST" enctype="multipart/form-data" novalidate="novalidate" >
                                            <input type="hidden" name="_method" value="PUT">
                                    @else
                                        <form class="floating-labels" action="{{url('patient/register')}}" method="POST" enctype="multipart/form-data" novalidate="novalidate" >

                                    @endif
                                    
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <select name="center_id" id="center_id" class="form-control" required="required">
                                                @foreach($centers as $center)
                                                <option value="{{$center->id}}">{{$center->name}}</option>
                                                @endforeach
                                            </select><span class="highlight"></span> <span class="bar"></span><label for="center_id">Center(*)</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="doctor_name" value="{{old('doctor_name',$patient->doctor_name)}}" class="form-control" required><span class="highlight"></span> <span class="bar"></span><label for="h_name">Ref. Doctor(*)</label>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                <select name="salutation" id="salutation" class="form-control input-sm" required="required">
                                                    <option></option>
                                                    <option>MR</option>
                                                    <option>MISS</option>
                                                    <option>MRS</option>
                                                    <option>DR</option>
                                                    <option>BABY</option>
                                                    <option>MASTER</option>
                                                    <option>C./O.</option>
                                                </select><span class="highlight"></span> <span class="bar"></span><label for="salutation">Salutation(*)</label>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="text" name="name" id="name" value="{{old('name',$patient->name)}}" class="form-control" required><span class="highlight"></span> <span class="bar"></span><label for="name">Patient Name(*)</label>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <input type="text" maxlength="3" pattern="\d{3}" name="age" id="age" value="{{old('age',$patient->age)}}" class="form-control" required><span class="highlight"></span> <span class="bar"></span><label for="age">Patient Age(*)</label>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="icheck-list col-md-12">
                                                    <div class="col-md-4">
                                                        <label><input type="radio" class="check" id="minimal-radio-1" data-radio="iradio_flat-red" value="male" name="gender">
                                                        Male</label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label><input type="radio" class="check" id="minimal-radio-2" data-radio="iradio_flat-red" value="female" name="gender">
                                                        Female</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label><input type="radio" class="check" id="minimal-radio-3" data-radio="iradio_flat-red" value="other" name="gender">
                                                        NA</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" maxlength="10" pattern="\d{10}" name="mobile" id="mobile" value="{{old('mobile',$patient->mobile)}}" class="form-control" required><span class="highlight"></span> <span class="bar"></span><label for="mobile">Patient 10 digit Mobile(*)</label>
                                            </div>
                                        </div>

                                        <hr/>
                                        
                                        <div class="form-group">
                                            <input type="text" class="form-control" data-role="tagsinput" name="vial_ids" value="{{old('vial_ids',$patient->vial_ids)}}" id="vial_ids" required><span class="highlight"></span> <span class="bar"></span><label for="vial_ids">Vial Id(s)*</label>
                                        </div>
                                        <div class="form-group">
                                            <h5 class="box-title">Select Tests</h5>
                                            <select id='pre-selected-options' name="tests" multiple='multiple'>
                                                <option value='elem_1'>elem 1</option>
                                                <option value='elem_2'>elem 2</option>
                                                <option value='elem_3'>elem 3</option>
                                                <option value='elem_4'>elem 4</option>
                                                <option value='elem_5'>elem 5</option>
                                                <option value="elem_6">elem 6</option>
                                                <option value="elem_7">elem 7</option>
                                                <option value="elem_8">elem 8</option>
                                                <option value="elem_9">elem 9</option>
                                                <option value="elem_10">elem 10</option>
                                                <option value="elem_11">elem 11</option>
                                                <option value="elem_12">elem 12</option>
                                                <option value="elem_13">elem 13</option>
                                                <option value="elem_14">elem 14</option>
                                                <option value="elem_15">elem 15</option>
                                                <option value="elem_16">elem 16</option>
                                                <option value="elem_17">elem 17</option>
                                                <option value="elem_18">elem 18</option>
                                                <option value="elem_19">elem 19</option>
                                                <option value="elem_20">elem 20</option>
                                            </select>
                                        </div>
                                        
                                        <hr/>
                                        <div class="form-group">
                                            <textarea name="medical_history" class="form-control" id="medical_history" required="required">{{old('medical_history',$patient->medical_history)}}</textarea><span class="highlight"></span> <span class="bar"></span><label for="medical_history">Medical History</label>
                                        </div>

                                        {{ csrf_field() }}                                                                            
                                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- .row -->
                <!-- /.row -->
                <!-- .row -->
                <!-- /.row -->                
            </div>
            <!-- /.container-fluid -->
            @include('layouts.footer') 
        </div>
        <!-- /#page-wrapper -->
@endsection