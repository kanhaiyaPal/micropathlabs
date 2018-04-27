@extends('layouts.dashboard')

@section('resources')

<!-- Editable -->
    <script src="{{ asset('plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
    <link href="{{ asset('plugins/bower_components/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />

    <script>
   
    $(document).ready(function() {

        var table = $('#editable-datatable').DataTable();

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
                        <h4 class="page-title">Manage Centers</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="active">Centers</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- .row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="white-box">
                            <div class="pull-left">
                            <h3 class="box-title">Change Center Details</h3>
                            <p class="text-muted">Just click on edit link</p> 
                            <p>&nbsp;</p>
                            </div>

                            <div class="pull-right">
                            <form style="display:inline" action="{{url('centeres/deleteall')}}" onsubmit="return confirm('Are you sure you want to delete selected item/s?')" method="POST" id="delete_all_form">
                            {{ csrf_field() }}  
                            <input type="hidden" name="fl_delete_all" value="" />
                            <input type="submit" class="btn btn-danger" value="Delete"/>
                            </form>
                            <a class="btn btn-info" href="{{ URL::to('centeres/create') }}" >Add New</a>
                            <a class="btn btn-info" href="{{ url('home') }}" >Back</a>
                            </div>
                            <div class="clear"></div>
                            <table class="table table-striped table-bordered" id="editable-datatable">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="checkAll" class="btn" /></th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Username for login</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach($centers as $center)
                                    <tr id="1" class="gradeX">
                                        <td><input type="checkbox" name="combined_delete[]" class="delete_c" value="{{$center->id}}" /></td>
                                        <td>{{$center->code}}</td>
                                        <td>{{$center->user_real_name}}</td>
                                        <td>{{$center->user_name}}</td>
                                        <td class="center">
                                        	<div class="btn-group" role="group">
								                <a href="{{ URL::to('centeres/' . $center->id . '/edit') }}">
								                   <button type="button" class="btn btn-warning">Edit</button>
								                </a>							                  
								                &nbsp; 
								            	<form action="{{url('centeres', [$center->id])}}" method="POST">
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