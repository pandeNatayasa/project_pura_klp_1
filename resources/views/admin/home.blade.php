<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard</title>
	<link rel="icon" href="user_img/temple-icon.png">
	<link type="text/css" href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
	<link type="text/css" href="{{ asset('bootstrap/css/bootstrap-responsive.min.css') }} " rel="stylesheet">
	<link type="text/css" href="{{ asset('css/theme.css') }}" rel="stylesheet">
	<link type="text/css" href="{{ asset('images/icons/css/font-awesome.css') }}" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
	
</head>
<body>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
          <i class="icon-reorder shaded"></i></a><a class="brand" href="{{ route('admin.home') }}">SISTEM INFORMASI PURA </a>
          <div class="nav-collapse collapse navbar-inverse-collapse">
              <ul class="nav pull-right">
                  <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <img src="{{ asset(Auth::user('admin')->profille_image) }}" class="nav-avatar" />
                      <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                          <li><a href="{{ route('show_profille_admin') }}">Your Profile</a></li>
                          <li class="divider"></li>
                          <li><a href="{{ route('admin.logout') }}">Logout</a></li>
                      </ul>
                  </li>
              </ul>
          </div>
			</div>
		</div><!-- /navbar-inner -->
	</div><!-- /navbar -->



	<div class="wrapper">
		<div class="container">
			<div class="row">
			
				<div class="span10">
					<div class="content">

						<div class="btn-controls">
							<div class="btn-box-row row-fluid">
								<a href="#" class="btn-box big span3">
									<i class="icon-plus-sign"></i>
									<b>Tambah Data Pura</b>
								</a>
								<a href="{{ route('show_list_temple') }}" class="btn-box big span3">
									<i class="icon-sitemap"></i>
									<b>Lihat Data Pura</b>
								</a>
								<a href="{{ route('show_list_temple_validate') }}" class="btn-box big span3">
									<i class="icon-check"></i>
									<b>Validasi Data Pura</b>
								</a>
								<a href="{{ route('admin.master-data') }}" class="btn-box big span3">
									<i class="icon-file-alt"></i>
									<b>Master Data Pura</b>
								</a>
							</div>
						</div><!--/.btn-controls-->
					</div><!--/.content-->
				</div><!--/.span8-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->
{{-- 
	<div class="footer">
		<div class="container" align="center">
			<b class="copyright">&copy; 2019 SI Pura </b> All rights reserved.
		</div>
	</div> --}}

	<script src="{{ asset('scripts/jquery-1.9.1.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('scripts/jquery-ui-1.10.1.custom.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>

</body>
</html>