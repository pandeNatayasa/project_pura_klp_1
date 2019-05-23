<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pura|Admin</title>

    <!-- Bootstrap -->
    <link href="{{ asset('public_admin/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('public_admin/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

    @yield('add_css')

    <!-- Custom Theme Style -->
    <link href="{{asset('public_admin/build/css/custom_version2.css')}}" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <div class="site_title">
                <a href="{{ route('admin.home') }}"><i style="color: white;" class="fa fa-arrow-left"></i></a><a href="{{ route('admin.master-data') }}" style="color: white;" > <span>Pura</span></a>
              </div>
            </div>
            <div class="clearfix"></div>
            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{ asset(Auth::guard('admin')->user()->profille_image) }}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Selamat Datang {{ Auth::guard('admin')->user()->name }}</span>
                <h2></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->
            <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  {{-- <li class="@yield('menu_dashboard')"><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Dashboard </a></li> --}}
                  <li><a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li class="fa fa-list @yield('menu_list_admin')"><a href="{{ route('admin.list-admin') }}">Daftar Admin</a></li>
                      <li class="fa fa-list @yield('menu_list_member')"><a href="{{ route('list-member.index') }}">Daftar Member</a></li>
                    </ul>
                  </li>
                  {{-- <li class="@yield('menu_pemangku')"><a href="#"><i class="fa fa-users"></i> Pemangku </a></li> --}}
                  <li class="@yield('menu_temple_type')"><a href="{{url('/admin/temple-type')}}"><i class="fa fa-diamond"></i> Jenis Pura </a></li>
                  <li><a><i class="fa fa-diamond"></i> Sasih <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li class="fa fa-list @yield('menu_list_sasih')"><a href="{{route('sasih.index')}}">Daftar Sasih</a></li>
                      <li class="fa fa-list @yield('menu_list_rahinan')"><a href="{{route('rahinan.index')}}">Daftar Hari Rahinan</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-diamond"></i> Wuku <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li class="fa fa-list @yield('menu_list_wuku')"><a href="{{route('wuku.index')}}">Daftar Wuku</a></li>
                      <li class="fa fa-list @yield('menu_list_saptawara')"><a href="{{route('saptawara.index')}}">Daftar Saptawara</a></li>
                      <li class="fa fa-list @yield('menu_list_pancawara')"><a href="{{route('pancawara.index')}}">Daftar Pancawara</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-globe"></i> Location <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li class="fa fa-list @yield('menu_list_sub_district')"><a href="{{route('sub-district.index')}}">List Sub-District</a></li>
                      <li class="fa fa-list @yield('menu_list_city')"><a href="{{route('city.index')}}">List City</a></li>
                      <li class="fa fa-list @yield('menu_list_province')"><a href="{{route('province.index')}}">List Province</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset(Auth::guard('admin')->user()->profille_image) }}" alt="">{{ Auth::guard('admin')->user()->name }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{ route('show_profille_admin') }}"> Profille </a></li>
                    <li><a href="{{ route('admin.logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- Your content here -->
          @yield('content')
        </div>

        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('public_admin/vendors/jquery/dist/jquery.min.js')}}"></script>
    
    <!-- Bootstrap -->
    <script src="{{asset('public_admin/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
       
    <!-- Custom Theme Scripts -->
    <script src="{{asset('public_admin/build/js/custom.js')}}"></script>

    @yield('add_js')
	
  </body>
</html>
