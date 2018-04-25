<!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <div class="user-profile">
                    <div class="dropdown user-pro-body">
                        <div><img src="{{ asset('../../assets/images/favicon.png') }}" alt="user-img" class="img-circle"></div>
                    </div>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                        <!-- input-group -->
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
            </span> </div>
                        <!-- /input-group -->
                    </li>
                    <li> <a href="{{ url('home') }}" class="waves-effect {{ Request::segment(1) === 'home' ? 'active' : null }}"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i> <span class="hide-menu"> Dashboard </span></a></li>
                    <li><a href="{{ url('globalsettings') }}" class="waves-effect {{ Request::segment(1) === 'globalsettings' ? 'active' : null }}"><i data-icon="&#xe028;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Global Settings</span></a>            
                    </li>
                    <li class="nav-small-cap m-t-10">---Patient Registration </li>
                    <li><a href="{{ url('patient/register') }}" class="waves-effect {{ Request::segment(1) === 'patient/register' ? 'active' : null }}"><i data-icon="R" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Sample Registration</span></a>            
                    </li>
                    <li class="nav-small-cap m-t-10">--- Yellow Pages Section</li>
                    <li><a href="{{ url('directorycategory') }}" class="waves-effect {{ Request::segment(1) === 'directorycategory' ? 'active' : null }}"><i data-icon="f" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Categories</span></a>  
                    <li><a href="{{ url('directorysubcategory') }}" class="waves-effect {{ Request::segment(1) === 'directorysubcategory' ? 'active' : null }}"><i data-icon="f" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Sub - Categories</span></a>          
                    </li>
                    <li><a href="{{ url('directorylisting') }}" class="waves-effect {{ Request::segment(1) === 'directorylisting' ? 'active' : null }}"><i data-icon="m" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Listings</span></a>          
                    </li>
                    <li class="nav-small-cap">--- User Responses Section</li>
                    <li><a href="{{ url('bainquiry') }}" class="waves-effect {{ Request::segment(1) === 'bainquiry' ? 'active' : null }}"><i data-icon="|" class="linea-icon linea-elaborate fa-fw"></i> <span class="hide-menu">Business Associates</span></a>          
                    </li>
                    <li><a href="{{ url('articlefeedback') }}" class="waves-effect {{ Request::segment(1) === 'articlefeedback' ? 'active' : null }}"><i data-icon="~" class="linea-icon linea-elaborate fa-fw"></i> <span class="hide-menu">Articles Feedback</span></a>          
                    </li>
                    <li><a href="{{ url('contactinquiry') }}" class="waves-effect {{ Request::segment(1) === 'contactinquiry' ? 'active' : null }}"><i data-icon="&#xe00a;" class="linea-icon linea-elaborate fa-fw"></i> <span class="hide-menu">Contact us inquiries</span></a>          
                    </li>
                    <li><a href="{{ url('claimlisting') }}" class="waves-effect {{ Request::segment(1) === 'claimlisting' ? 'active' : null }}"><i data-icon="&#xe008;" class="linea-icon linea-elaborate fa-fw"></i> <span class="hide-menu">Claim Listing Inquiries</span></a>          
                    </li>
                    <li class="nav-small-cap">--- Static Page Content</li>                    
                    <li><a href="{{ url('pagecontent') }}" class="waves-effect {{ Request::segment(1) === 'pagecontent' ? 'active' : null }}"><i data-icon="&#xe00b;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Static Page Content</span></a>          
                    </li>

                    <li class="nav-small-cap">---Content Section</li> 
                    <!--Articles Section-->
                    <li class="{{ ((Request::segment(1) === 'articlecategory') or (Request::segment(1) === 'articlesubcategory') or (Request::segment(1) === 'article'))? 'active' : null }}"> <a href="javascript:void(0)" class="waves-effect"><i data-icon="&#xe008;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Articles<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="{{ url('articlecategory') }}" class="waves-effect">Article Category</a></li>
                            <li><a href="{{ url('articlesubcategory') }}" class="waves-effect">Article Sub Category</a></li>
                            <li><a href="{{ url('sitearticles') }}" class="waves-effect">Articles</a></li>
                        </ul>
                    </li>

                    <!--Gallery Section-->
                    <li><a href="{{ url('gallery') }}" class="waves-effect {{ Request::segment(1) === 'gallery' ? 'active' : null }}"><i data-icon="^" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Gallery</span></a>        
                    </li>

                    <!--Ads Section-->
                    <li><a href="{{ url('ads') }}" class="waves-effect {{ Request::segment(1) === 'ads' ? 'active' : null }}"><i data-icon=">" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Ads</span></a>        
                    </li>

                    <!--Postioning Contents Section-->
                    <li><a href="{{ url('contentpositioning') }}" class="waves-effect {{ Request::segment(1) === 'contentpositioning' ? 'active' : null }}"><i data-icon="/" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Content Positioning</span></a>        
                    </li>

                    <!--SEO Section-->
                    <li><a href="{{ url('seosettings') }}" class="waves-effect {{ Request::segment(1) === 'seosettings' ? 'active' : null }}"><i data-icon="u" class="linea-icon linea-elaborate fa-fw"></i> <span class="hide-menu">Seo</span></a>        
                    </li>

                    <!--Blog Section-->
                    <li><a href="{{ url('siteblogs') }}" class="waves-effect {{ Request::segment(1) === 'siteblogs' ? 'active' : null }}"><i data-icon="." class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Blogs </span></a>          
                    </li>

                    <!--Members Section-->
                    <li class="nav-small-cap">--- Members/User Section</li>                    
                    <li><a href="{{ url('sitemembers') }}" class="waves-effect {{ Request::segment(1) === 'sitemembers' ? 'active' : null }}"><i data-icon="&#xe006;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Users/Members </span></a>          
                    </li>

                    <!--Exports Section-->
                    <li class="nav-small-cap">--- Export Data Section</li>                    
                    <li><a href="{{ url('exportyp') }}" class="waves-effect {{ Request::segment(1) === 'exportyp' ? 'active' : null }}"><i data-icon="M" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Yellow Pages</span></a>          
                    </li>
                    <li><a href="{{ url('exportarticles') }}" class="waves-effect {{ Request::segment(1) === 'exportarticles' ? 'active' : null }}"><i data-icon="M" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Articles</span></a>          
                    </li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="waves-effect"><i class="icon-logout fa-fw"></i> <span class="hide-menu">Log out</span></a></li>
                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->