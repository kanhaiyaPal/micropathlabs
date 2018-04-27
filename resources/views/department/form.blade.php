@extends('layouts.dashboard')

@section('resources')
   
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
                        <h4 class="page-title">Add New Center</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="active">New Center</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- .row -->
                <div class="row">
                    <div class="col-md-12">
                        @if(isset($department->id))
                            <form class="floating-labels" action="{{url('departments', [$department->id])}}" method="POST" enctype="multipart/form-data" novalidate="novalidate" >
                                <input type="hidden" name="_method" value="PUT">
                        @else
                            <form class="floating-labels" action="{{url('departments/create')}}" method="POST" enctype="multipart/form-data" novalidate="novalidate" >

                        @endif
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Add New Department</h3>
                            <p class="text-muted m-b-30 font-13">Department Information</p>

                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    
                                    
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
                                            <?php $old_rname = ''; if(isset($department->id)){ $old_rname = $department->user_real_name; } ;  ?>
                                            <input type="text" name="name" value="{{old('name',$old_rname)}}" id="department_name" class="form-control" required><span class="highlight"></span> <span class="bar"></span><label for="department_name">Name of Department(*)</label>
                                        </div>

                                        <div class="form-group">
                                            <?php $old_email_id = ''; if(isset($department->id)){ $old_email_id = $department->user_email; } ;  ?>
                                            <input type="email" name="email" value="{{old('email',$old_email_id)}}" id="center_email" class="form-control" required><span class="highlight"></span> <span class="bar"></span><label for="center_email">Deaprtment Email Id(*)</label>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-10">                                            
                                            <select name="signature_id" id="signature_id" class="form-control input-sm" required="required">
                                                <option></option>
                                            @if($sign_permission['view'])
                                            @foreach($signatures as $signature)

                                            @if($department->signature_id == $signature->id)
                                                <option selected="selected" value="{{$signature->id}}">{{$signature->name}}</option>
                                            @else
                                                <option value="{{$signature->id}}">{{$signature->name}}</option>
                                            @endif
                                            
                                            @endforeach
                                            @endif                                                                                     
                                            </select><span class="highlight"></span> <span class="bar"></span><label for="signature_id">Authorized Signatory(*)</label>  </div>
                                            <div class="col-md-2 input-group">  
                                            <span class="input-group-addon col-md-12" id="basic-addon2"><a href="{{ url('signatures/create') }}">Add New</a></span>   
                                            </div>                       
                                        </div>

                                        @if(isset($department->id))

                                        <div class="form-group">
                                            <input type="hidden" name="user_id" value="{{$department->user_id}}">
                                            <input type="password" name="new_password" value="" id="password" class="form-control" required><span class="highlight"></span> <span class="bar"></span><label for="password">Change Password</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="password" name="new_password_confirmation" value="" id="password_confirmation" class="form-control" required><span class="highlight"></span> <span class="bar"></span><label for="password_confirmation">Confirm Changed Password</label>
                                        </div>

                                        @else

                                        <div class="form-group">
                                            <input type="text" name="username" value="{{old('username')}}" id="username" class="form-control" required><span class="highlight"></span> <span class="bar"></span><label for="username">Username(*)</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="password" name="password" value="" id="password" class="form-control" required><span class="highlight"></span> <span class="bar"></span><label for="password">Password(*)</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="password" name="password_confirmation" value="" id="password_confirmation" class="form-control" required><span class="highlight"></span> <span class="bar"></span><label for="password_confirmation">Confirm New Password(*)</label>
                                        </div>

                                        @endif                                        

                                        {{ csrf_field() }}                                                                            
                                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                                        <a href="{{ url('departments') }}" class="btn btn-inverse waves-effect waves-light">Cancel</a>
                                    </div>
                                </div>
                            </div><!--.white-box-->                            
                        </div>
                    </form>
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