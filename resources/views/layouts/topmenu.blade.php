<!-- Top Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
                <div class="top-left-part"><a class="logo" href="{{ url('home') }}"><b><!--This is dark logo icon--><img src="{{ asset('../../assets/images/favicon.png') }}" alt="home" width="60px" class="dark-logo" /><!--This is light logo icon--><img src="{{ asset('../../assets/images/favicon.png') }}" alt="home" class="light-logo"  width="60px"  /></b><span class="hidden-xs"><!--This is dark logo text--><img src="{{ asset('../../assets/images/logo.png') }}" alt="home"  width="102px"  class="dark-logo" /><!--This is light logo text--><img width="102px" src="{{ asset('../../assets/images/logo.png') }}" alt="home" class="light-logo" /></span></a></div>
                <ul class="nav navbar-top-links navbar-left hidden-xs">
                    <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li>
                    <li>
                        <form role="search" class="app-search hidden-xs">
                            <input type="text" placeholder="Search..." class="form-control">
                            <a href=""><i class="fa fa-search"></i></a>
                        </form>
                    </li>
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">  
                  <li class="dropdown">
                     <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#">
                        <i class="icon-note"></i>
                        <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
                     </a>
                     <ul class="dropdown-menu dropdown-tasks animated slideInUp">
                        <li>
                           <a href="javascript:void(0)">
                              <div>
                                 <form action="{{url('changeadmincredentials')}}" method="post" class="form-horizontal floating-labels" novalidate="novalidate">
                                    <div class="form-group ">                                    
                                        <input class="form-control" id="admin_email" type="email" name="admin_email" value="{{ Auth::user()->email }}" required><span class="highlight"></span> <span class="bar"></span><label for="admin_email">Enter Email Id(*)</label>
                                    </div>
                                    <div class="form-group ">
                                        <input class="form-control" id="current_password" type="password" name="current_password" value="" required><span class="highlight"></span> <span class="bar"></span><label for="current_password">Current Password(*)</label>
                                    </div>
                                    <div class="form-group ">
                                        <input class="form-control" id="new_password" type="password" name="new_password" value="" required><span class="highlight"></span> <span class="bar"></span><label for="new_password">New Password(*)</label>
                                    </div>
                                    <div class="form-group ">
                                        <input class="form-control" id="confirm_password" type="password" name="confirm_password" value="" required><span class="highlight"></span> <span class="bar"></span><label for="confirm_password">Confirm New Password(*)</label>
                                    </div>
                                   @csrf
                                   <input type="submit" class="btn btn-primary" value="Save">
                               </form>
                              </div>
                           </a>
                        </li>                        
                     </ul>
                  </li>                
                  
               </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->