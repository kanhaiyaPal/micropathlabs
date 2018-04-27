@extends('layouts.dashboard')

@section('resources')

<!-- Editable -->
    <script src="{{ asset('plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
    <link href="{{ asset('plugins/bower_components/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('js/cbpFWTabs.js') }}"></script>
    <script>
    (function() {

        [].slice.call(document.querySelectorAll('.sttabs')).forEach(function(el) {
            new CBPFWTabs(el);
        });

    })();
    $(document).ready(function() {

        var table = $('#editable-datatable').DataTable();
        var table1 = $('#editable-datatable-sign').DataTable();

        $('#checkAll').click(function () {
            $(':checkbox', table.rows({ page: 'current' }).nodes()).prop('checked', this.checked);
        });

        $( "form#delete_all_form" ).submit(function( event ) {
           
           if($(".delete_c:checkbox:checked").length > 0){
                var inps = $('input:checkbox:checked[name="combined_delete[]"]');
                var input_array = [];
                for (var i = 0; i <inps.length; i++) {
                    var inp=inps[i];
                    input_array[i] = inp.value;
                }
                $("input[name='fl_delete_all']").val(input_array.join(','));
           }else {
                alert("At least make 1 selection");
               return false;
           }
        });

        $( "form#delete_all_signatures_form" ).submit(function( event ) {
           
           if($(".delete_sc:checkbox:checked").length > 0){
                var inps = $('input:checkbox:checked[name="combined_sign_delete[]"]');
                var input_array = [];
                for (var i = 0; i <inps.length; i++) {
                    var inp=inps[i];
                    input_array[i] = inp.value;
                }
                $("input[name='fl_delete_all']").val(input_array.join(','));
           }else {
                alert("At least make 1 selection");
               return false;
           }
        });
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
                        <h4 class="page-title">Manage Department/Signatures</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="active">Departments/Signatures</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- .row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sttabs tabs-style-bar">
                            <nav>
                                <ul>
                                    <li><a href="#section-bar-1" class="sticon ti-user"><span>Departments</span></a></li>
                                    <li><a href="#section-bar-2" class="sticon ti-user"><span>Signatures</span></a></li>
                                </ul>
                            </nav>
                            <div class="content-wrap white-box">
                                <section id="section-bar-1">
                                    <div class="pull-left">
                                    <h3 class="box-title">Change Department Details</h3>
                                    <p class="text-muted">Just click on edit link</p> 
                                    <p>&nbsp;</p>
                                    </div>

                                    <div class="pull-right">
                                    <form style="display:inline" action="{{url('departments/deleteall')}}" onsubmit="return confirm('Are you sure you want to delete selected item/s?')" method="POST" id="delete_all_form">
                                    {{ csrf_field() }}  
                                    <input type="hidden" name="fl_delete_all" value="" />
                                    <input type="submit" class="btn btn-danger" value="Delete"/>
                                    </form>
                                    <a class="btn btn-info" href="{{ URL::to('departments/create') }}" >Add New</a>
                                    <a class="btn btn-info" href="{{ url('home') }}" >Back</a>
                                    </div>
                                    <div class="clear"></div>
                                    <table class="table table-striped table-bordered" id="editable-datatable">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="checkAll" class="btn" /></th>
                                                <th>Deparmtent Name</th>
                                                <th>Username for login</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($departments as $department)
                                            <tr id="1" class="gradeX">
                                                <td><input type="checkbox" name="combined_delete[]" class="delete_c" value="{{$department->id}}" /></td>
                                                <td>{{$department->user_real_name}}</td>
                                                <td>{{$department->user_name}}</td>
                                                <td class="center">
                                                	<div class="btn-group" role="group">
        								                <a href="{{ URL::to('departments/' . $department->id . '/edit') }}">
        								                   <button type="button" class="btn btn-warning">Edit</button>
        								                </a>							                  
        								                &nbsp; 
        								            	<form action="{{url('departments', [$department->id])}}" method="POST">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        {{ csrf_field() }}  
                                                        <input type="submit" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-danger" value="Delete"/>
                                                        </form>					                  
        						                	</div>
                                                </td>
                                            </tr>     
                                            @endforeach                               
                                        </tbody>
                                    </table>
                                </section>
                                <section id="section-bar-2">
                                    @if($sign_permission['view'])
                                    <div class="pull-left">
                                    <h3 class="box-title">Change Signatures Details</h3>
                                    <p class="text-muted">Just click on edit link</p> 
                                    <p>&nbsp;</p>
                                    </div>

                                    <div class="pull-right">
                                    <form style="display:inline" action="{{url('signatures/deleteall')}}" onsubmit="return confirm('Are you sure you want to delete selected item/s?')" method="POST" id="delete_all_signatures_form">
                                    {{ csrf_field() }}  
                                    <input type="hidden" name="fl_delete_all" value="" />
                                    <input type="submit" class="btn btn-danger" value="Delete"/>
                                    </form>
                                    <a class="btn btn-info" href="{{ URL::to('signatures/create') }}" >Add New</a>
                                    <a class="btn btn-info" href="{{ url('home') }}" >Back</a>
                                    </div>
                                    <div class="clear"></div>
                                    <table class="table table-striped table-bordered" id="editable-datatable-sign">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="checkAll" class="btn" /></th>
                                                <th>Authority Name</th>
                                                <th>Signature</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($signatures as $signature)
                                            <tr id="1" class="gradeX">
                                                <td><input type="checkbox" name="combined_sign_delete[]" class="delete_sc" value="{{$signature->id}}" /></td>
                                                <td>{{$signature->name}}</td>
                                                <td><img src="{{URL::to('/uploads/signatures').'/'.$signature->image}}" width="50" /></td>
                                                <td class="center">
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ URL::to('signatures/' . $signature->id . '/edit') }}">
                                                           <button type="button" class="btn btn-warning">Edit</button>
                                                        </a>                                              
                                                        &nbsp; 
                                                        <form action="{{url('signatures', [$signature->id])}}" method="POST">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        {{ csrf_field() }}  
                                                        <input type="submit" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-danger" value="Delete"/>
                                                        </form>                                   
                                                    </div>
                                                </td>
                                            </tr>     
                                            @endforeach                               
                                        </tbody>
                                    </table>
                                    @else

                                    You do not have permission to access this module. Kindly contact admin to get access.
                                    @endif
                                </section>
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