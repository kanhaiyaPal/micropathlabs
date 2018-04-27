@extends('layouts.dashboard')

@section('resources')
   <link rel="stylesheet" href="{{ asset('plugins/bower_components/dropify/dist/css/dropify.min.css') }}">
   <script src="{{ asset('plugins/bower_components/dropify/dist/js/dropify.min.js') }}"></script>
   <script>
    $(document).ready(function() {
    // Basic
        $('.dropify').dropify();  

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
                        <h4 class="page-title">Upload Signature</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="active">Signatures</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- .row -->
                <div class="row">
                    <div class="col-md-12">
                        @if(isset($signature->id))
                            <form class="floating-labels" action="{{url('signatures', [$signature->id])}}" method="POST" enctype="multipart/form-data" novalidate="novalidate" >
                                <input type="hidden" name="_method" value="PUT">
                        @else
                            <form class="floating-labels" action="{{url('signatures/create')}}" method="POST" enctype="multipart/form-data" novalidate="novalidate" >

                        @endif
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Add New Signature</h3>
                            <p class="text-muted m-b-30 font-13">Signature Information</p>

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
                                            <input type="text" name="signatory_name" value="{{old('signatory_name',$signature->name)}}" id="signatory_name" class="form-control" required><span class="highlight"></span> <span class="bar"></span><label for="signatory_name">Name of Authority(*)</label>
                                        </div>

                                        @if(!empty($signature->image) and file_exists($path.'/'.$signature->image))
                                         <input type="hidden" name="old_image" value="{{ $signature->image }}">
                                        @endif

                                        <div class="form-group">
                                            <span class="text-primary" >Signature Image(*)</span>
                                            <input type="file" name="image" value="" class="dropify form-control"  
                                            @if(!empty($signature->image) and file_exists($path.'/'.$signature->image))
                                            data-default-file="{{ URL::to('/uploads/signatures/'.$signature->image) }}" data-show-remove="false"                                           
                                            @endif
                                            >
                                        </div>                                                                              

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