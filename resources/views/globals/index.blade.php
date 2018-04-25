@extends('layouts.dashboard')

@section('resources')

<!-- Editable -->
    <script src="{{ asset('plugins/bower_components/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/icheck/icheck.init.js') }}"></script>
    <link href="{{ asset('plugins/bower_components/icheck/skins/all.css') }}" rel="stylesheet">
    <script src="{{ asset('js/cbpFWTabs.js') }}"></script>
    <script>   
    (function() {

        [].slice.call(document.querySelectorAll('.sttabs')).forEach(function(el) {
            new CBPFWTabs(el);
        });

    })();

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
                        <h4 class="page-title">Manage User Role Permissions</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="active">Role Permissions</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- .row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="white-box">
                            <div class="pull-left">
                            <h3 class="box-title">Change Various Roles Permissions</h3>
                            <p class="text-muted">Just click on user type</p>
                            </div>
                            <div class="pull-right">
                            <a class="btn btn-info" href="{{ url('home') }}" >Back</a>
                            </div>
                            <div class="clear"></div>
                            <form action="{{ url('saveglobalsettings') }}" method="post" >
                            <section>
                                <div class="sttabs tabs-style-bar">
                                    <nav>
                                        <ul>
                                            <?php $count = 1; ?>
                                            @foreach($roles_data as $index => $value)
                                            <li><a href="#section-bar-{{$count}}" class="sticon ti-user"><span>{{ucfirst($index)}}</span></a></li>  
                                            <?php $count += 1; ?>                                           
                                            @endforeach
                                        </ul>
                                    </nav>
                                    <div class="content-wrap">
                                        <?php $count_t = 1; ?>
                                        @foreach($roles_data as $sindex => $svalue)
                                        <section id="section-bar-{{$count_t}}">
                                            <h2>{{ucfirst($sindex)}} User Permissions</h2>
                                            <table class="table">
                                                <tr>
                                                    <th>Module</th>
                                                    <th>View</th>
                                                    <th>Read</th>
                                                    <th>Write</th>
                                                    <th>Modify</th>
                                                    <th>Delete</th>
                                                </tr>
                                                @foreach($svalue as $s_inventory)
                                                    <tr>
                                                    <?php 
                                                    $write_delete_disabled = ''; 
                                                    if($s_inventory->module_name == 'global_settings'){
                                                        $write_delete_disabled = 'disabled="disabled"';
                                                    }
                                                    ?>
                                                    <td>{{ $s_inventory->module_name }}</td>
                                                    <td>
                                                        @if($s_inventory->view_module == '1')
                                                        <input type="checkbox" class="check" checked="checked"  data-checkbox="icheckbox_flat-green" value="1" name="{{$s_inventory->module_name}}_{{$sindex}}_view"> 
                                                        @else
                                                        <input type="checkbox" name="{{$s_inventory->module_name}}_{{$sindex}}_view" class="check" value="1" data-checkbox="icheckbox_flat-green"> 
                                                        @endif                                                                
                                                    </td>
                                                    <td>
                                                        @if($s_inventory->read_module == '1')
                                                        <input type="checkbox" class="check" checked="checked"  data-checkbox="icheckbox_flat-green" value="1" name="{{$s_inventory->module_name}}_{{$sindex}}_read"> 
                                                        @else
                                                        <input type="checkbox" name="{{$s_inventory->module_name}}_{{$sindex}}_read" class="check" value="1" data-checkbox="icheckbox_flat-green"> 
                                                        @endif                                                                
                                                    </td>
                                                    <td>
                                                        @if($s_inventory->write_module == '1')
                                                        <input {{$write_delete_disabled}} type="checkbox" name="{{$s_inventory->module_name}}_{{$sindex}}_write" value="1" class="check" checked="checked"  data-checkbox="icheckbox_flat-green"> 
                                                        @else
                                                        <input {{$write_delete_disabled}} name="{{$s_inventory->module_name}}_{{$sindex}}_write" value="1" type="checkbox" class="check"  data-checkbox="icheckbox_flat-green"> 
                                                        @endif 
                                                    </td>
                                                    <td>
                                                        @if($s_inventory->modify_module == '1')
                                                        <input type="checkbox" class="check" name="{{$s_inventory->module_name}}_{{$sindex}}_modify" value="1" checked="checked"  data-checkbox="icheckbox_flat-green"> 
                                                        @else
                                                        <input type="checkbox" value="1" name="{{$s_inventory->module_name}}_{{$sindex}}_modify" class="check"  data-checkbox="icheckbox_flat-green"> 
                                                        @endif 
                                                    </td>
                                                    <td>
                                                        @if($s_inventory->delete_module == '1')
                                                        <input {{$write_delete_disabled}} type="checkbox" name="{{$s_inventory->module_name}}_{{$sindex}}_delete" value="1" class="check" checked="checked"  data-checkbox="icheckbox_flat-green"> 
                                                        @else
                                                        <input {{$write_delete_disabled}} name="{{$s_inventory->module_name}}_{{$sindex}}_delete" value="1" type="checkbox" class="check"  data-checkbox="icheckbox_flat-green"> 
                                                        @endif 
                                                    </td>                                                    
                                                </tr>
                                                @endforeach
                                            </table>
                                        </section>
                                        <?php $count_t += 1; ?>                                           
                                        @endforeach                                                  
                                    </div>
                                    <!-- /content -->
                                </div>
                                <!-- /tabs -->
                            </section>
                            @csrf
                            <div class="col-md-12 text-center"><input type="submit" class="btn btn-success" value="Save Settings" /></div>
                            </form>
                            <div class="clear"></div>
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