@extends('layouts.dashboard')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Dashboard Page</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">No Permission to access</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!--row -->
                
                    <div class="error-box">
                        <div class="error-body text-center">
                            <h2>No Permission to access the requested module </h2>
                            <h3 class="text-uppercase">Kindly contact admin to get access rights.</h3>
                            <p class="text-muted m-t-30 m-b-30">mail at admin@gmail.com</p>
                            <a href="{{url('home')}}" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">Back to home</a> 
                        </div>
                        @include('layouts.footer') 
                    </div>
                
            </div>
        </div>    
@endsection
