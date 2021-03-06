<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pura|Member</title>

    <!-- Bootstrap -->
    <link href="{{ asset('public_admin/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('public_admin/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

    @yield('add_css')

    <!-- Custom Theme Style -->
    <link href="{{asset('public_admin/build/css/custom.css')}}" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Pura</span></a>
            </div>
            <div class="clearfix"></div>
            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="#" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Selamat Datang,</span>
                <h2></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->
            <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li class="@yield('menu_dashboard')"><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Dashboard </a></li>
                  <li><a><i class="fa fa-dashboard"></i> Pura <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li class="fa fa-plus-circle @yield('menu_add_product')"><a href="{{route('temple.create')}}">Tambah Pura</a></li>
                      <li class="fa fa-list @yield('menu_list_product')"><a href="{{route('temple.index')}}">Daftar Pura</a></li>
                      <li class="fa fa-edit @yield('menu_update_temple')"><a href="#">Edit Pura</a></li>
                    </ul>
                  </li>
                  <li class="@yield('menu_pemangku')"><a href="#"><i class="fa fa-users"></i> Pemangku </a></li>
                  <li><a><i class="fa fa-diamond"></i> Sasih <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li class="fa fa-plus-circle @yield('menu_add_sasih')"><a href="#">Tambah Sasih</a></li>
                      <li class="fa fa-list @yield('menu_list_sasih')"><a href="#">Sasih</a></li>
                      <li class="fa fa-edit @yield('menu_update_sasih')"><a href="#">Edit Sasih</a></li>
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
                    <img src="#" alt="">admin
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{route('member.logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
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
