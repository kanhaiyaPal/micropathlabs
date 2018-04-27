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
                        @if(isset($center->id))
                            <form class="floating-labels" action="{{url('centeres', [$center->id])}}" method="POST" enctype="multipart/form-data" novalidate="novalidate" >
                                <input type="hidden" name="_method" value="PUT">
                        @else
                            <form class="floating-labels" action="{{url('centeres/create')}}" method="POST" enctype="multipart/form-data" novalidate="novalidate" >

                        @endif
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Add New Center</h3>
                            <p class="text-muted m-b-30 font-13">Add New Center</p>

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
                                            <input type="text" name="code" value="{{old('code',$center->code)}}" id="center_code" class="form-control" required><span class="highlight"></span> <span class="bar"></span><label for="center_code">Code of Center(*)</label>
                                        </div>
                                        
                                        <div class="form-group">
                                            <?php $old_rname = ''; if(isset($center->id)){ $old_rname = $center->user_real_name; } ;  ?>
                                            <input type="text" name="name" value="{{old('name',$old_rname)}}" id="center_name" class="form-control" required><span class="highlight"></span> <span class="bar"></span><label for="center_name">Name of Center(*)</label>
                                        </div>

                                        <div class="form-group">
                                            <?php $old_email_id = ''; if(isset($center->id)){ $old_email_id = $center->user_email; } ;  ?>
                                            <input type="email" name="email" value="{{old('email',$old_email_id)}}" id="center_email" class="form-control" required><span class="highlight"></span> <span class="bar"></span><label for="center_email">Center Email Id(*)</label>
                                        </div>

                                        <div class="form-group">
                                            <textarea name="address" class="form-control" id="address" required="required">{{old('address',$center->address)}}</textarea><span class="highlight"></span> <span class="bar"></span><label for="address">Center Address</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="role" value="{{old('role',$center->role)}}" id="role" class="form-control" required><span class="highlight"></span> <span class="bar"></span><label for="role">Role</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="division" value="{{old('division',$center->division)}}" id="division" class="form-control" required><span class="highlight"></span> <span class="bar"></span><label for="division">Division</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="psc" value="{{old('psc',$center->psc)}}" id="psc" class="form-control" required><span class="highlight"></span> <span class="bar"></span><label for="psc">PSC</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="lab" value="{{old('lab',$center->lab)}}" id="lab" class="form-control" required><span class="highlight"></span> <span class="bar"></span><label for="lab">Lab</label>
                                        </div>


                                        <div class="form-group">
                                            <input type="text" name="advance" value="{{old('advance',$center->advance)}}" id="advance" class="form-control" required><span class="highlight"></span> <span class="bar"></span><label for="advance">Advance Paid(Rs)</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="sales_officer" value="{{old('sales_officer',$center->sales_officer)}}" id="sales_officer" class="form-control" required><span class="highlight"></span> <span class="bar"></span><label for="sales_officer">Sales Officer Name(*)</label>
                                        </div>
                                        
                                        <div class="form-group">                                            
                                            <select name="billing_cycle" id="billing_cycle" class="form-control input-sm" required="required">
                                                <option></option>
                                                <option value="monthly" <?php if(old('billing_cycle',$center->billing_cycle) == "monthly"){ echo "selected='selected'"; } ?>>Monthly</option>
                                                <option value="daily" <?php if(old('billing_cycle',$center->billing_cycle) == "daily"){ echo "selected='selected'"; } ?>>Daily</option>                                              
                                            </select><span class="highlight"></span> <span class="bar"></span><label for="billing_cycle">Billing Cycle(*)</label>                                            
                                        </div>     

                                        @if(isset($center->id))

                                        <div class="form-group">
                                            <input type="hidden" name="user_id" value="{{$center->user_id}}">
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
                                        <a href="{{ url('centeres') }}" class="btn btn-inverse waves-effect waves-light">Cancel</a>
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