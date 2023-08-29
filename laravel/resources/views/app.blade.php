<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{!! isset($title) ? $title." | " : "" !!}OMEGA</title>

	<!-- LOAD JQUERY LIBRARY -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	
	<!-- Loading Bootstrap -->
	<link href="{{ URL::asset('public/css/bootstrap.min.css') }}" rel="stylesheet">

	<!-- Loading Template CSS -->
	<link href="{{ URL::asset('public/css/style.css?v=2') }}" rel="stylesheet">
	<link href="{{ URL::asset('public/css/style-magnific-popup.min.css') }}" rel="stylesheet">
	
	<!-- Bootoast CSS -->
	<link href="{{ URL::asset('public/css/bootoast.min.css') }}" rel="stylesheet">

	<!-- Bootstrap Select -->
	<link href="{{ URL::asset('public/css/select2.min.css') }}" rel="stylesheet">

	<!-- Font Awesome -->
	<link href="{{ URL::asset('public/css/fonts.min.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('public/font/flaticon.min.css') }}" rel="stylesheet">
	<style>
	@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
	</style>    
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,400i,700,700i,900" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300i,400,400i,600,600i,700,700i,800" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oleo+Script+Swash+Caps" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lobster|Oleo+Script+Swash+Caps" rel="stylesheet">

	<!-- LOADING FONTS AND ICONS -->        
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/revolution/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/revolution/fonts/font-awesome/css/font-awesome.min.css') }}">

	<!-- Font Favicon -->
	<link rel="shortcut icon" href="{{ URL::asset('public/images/favicon.ico') }}">

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
	<!--[if lt IE 9]>
	  <script src="{{ URL::asset('public/js/html5shiv.js') }}"></script>
	  <script src="{{ URL::asset('public/js/respond.min.js') }}"></script>
	<![endif]-->
	
	<!--headerIncludes-->
	<style>
	.navbar-toggle, .navbar-toggle:focus{
	border: 1px solid #fff !important;
	background: #fff !important;
	margin-top: 15px
	}
	.pagination > li > a, .pagination > li > span {
		position: relative;
		float: left;
		padding: 8px 14px;
		margin: 2px;
		line-height: 1.42857143;
		color: #337ab7;
		text-decoration: none;
		background-color: #fff;
		border: 1px solid #ddd;
	}
	.pagination > li:first-child > a, .pagination > li:first-child > span {
		border-top-left-radius: 0;
		border-bottom-left-radius: 0;
	}
	.pagination > li:last-child > a, .pagination > li:last-child > span {
		border-top-right-radius: 0;
		border-bottom-right-radius: 0;
	}
	.pagination > .active > a, .pagination > .active > a:focus, .pagination > .active > a:hover, .pagination > .active > span, .pagination > .active > span:focus, .pagination > .active > span:hover {
		background-color: #007adf;
		border-color: #007adf;
	}
	.pagination > li > a:focus, .pagination > li > a:hover, .pagination > li > span:focus, .pagination > li > span:hover {
		color: #007adf;
	}
	.camera_loader{
		display: none !important;
		width: 1px;
		height: 1px;
	}
	#overlay{	
  position: fixed;
  top: 0;
  z-index: 100;
  width: 100%;
  height:100%;
  display: none;
  background: rgba(0,0,0,0.6);
}
.cv-spinner {
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;  
}
.spinner {
  width: 40px;
  height: 40px;
  border: 4px #ddd solid;
  border-top: 4px #2e93e6 solid;
  border-radius: 50%;
  animation: sp-anime 0.8s infinite linear;
}
@keyframes sp-anime {
  100% { 
	transform: rotate(360deg); 
  }
}
	.icon-badge-group .icon-badge-container {
	display: inline-block;
	margin-left: 15px;
	}

	.icon-badge-group .icon-badge-container:first-child {
	margin-left: 0
	}

	.icon-badge-container {
		margin-top: 10px;
		position: relative;
		display: inline-block;
	}

	.icon-badge-icon {
	font-size: 30px;
	position: relative;
	}

	.icon-badge {
		background-color: #115bc9;
		font-size: 12px;
		color: white;
		text-align: center;
		width: 20px;
		height: 20px;
		border-radius: 35%;
		position: absolute;
		top: -12px;
		right: -10px;
			font-weight: 600;
	}

	.btn-li-user{
		background: #003059;
		color: #fff;
		padding: 10px 15px;
		border-radius: 20px;
		font-weight: 400;
	}
	.btn-li-login-togle{
		background: #003059;
		color: #fff;
		padding: 10px 15px;
		border-radius: 20px;
		font-weight: 400;
		margin: 0;
		top: -4px;
		position: relative;
		border: 1px solid #003059;
	}
	.btn-li-login{
		color: #003059;
		padding: 10px 15px;
		border-radius: 20px;
		font-weight: 400;
		margin: 0;
		top: -4px;
		position: relative;
		border: 1px solid #003059;
		cursor: pointer;
	}
	</style>
	@yield('style')
</head>
<body>
	<!--begin top-intro -->
	<div class="top-intro" id="top-intro">
	
		<!--begin container-->
		<div class="container"> 

			<!--begin row-->
			<div class="row">
			
				<!--begin col-sm-4-->
				<div class="col-sm-4 details-wrapper">

					<!--begin header_contact -->
					<ul class="header_contact" style="margin-bottom:5px">
						<li style="padding-left:0"><a href="{!! route('contacta-con-nosotros') !!}"><i class="icon icon-pin-map"></i> Av. Santiago Antunez de Mayolo, Lima-Perú</a></li>
					</ul>
					<!--end header_contact -->

				</div>
				<!--end col-sm-4 -->
				 
				<!--begin col-sm-8-->
				<div class="col-sm-8">

					<!--begin header_contact -->
					<ul class="header_contact pull-right" style="margin-bottom:5px">
						<li><a href="{!! route('contacta-con-nosotros') !!}"><i class="icon icon-email-envelope"></i> ventas@omega.com</a></li>
						<li><i class="icon icon-call-phone"></i>(+511) 528 1261</li>
					</ul>
					<!--end header_contact -->

				</div>
				<!--end col-sm-8 -->
					   
			</div>
			<!--end row -->
					
		</div>
		<!--end container -->
				
	</div>
	<!--end top-intro -->

	<!--begin header -->
	<header class="header">

		<!-- begin navbar -->
		<div class="navbar yamm navbar-default ">
		  
			<!-- begin container -->
			<div class="container">

				<!-- begin navbar-header -->
				<div class="navbar-header">
					<button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<div class="navbar-toggle" style="margin: 5px;padding:0px;">
						@include('auth.btn-login-shopping')
					</div>
					<a href="{!! route('home') !!}" class="navbar-brand brand scrool" id="logo" style="margin-top: 9px; padding-bottom: 0; margin-bottom: 0px; padding-top: 0px;"><img src="{{ URL::asset('public/images/logo.png') }}" style="height:100%"></a>
					
				</div>
				<!-- end navbar-header -->

				<!-- begin navbar -->
				@php
				
				use App\Models\Categorias;
				$categorias = Categorias::all();
				@endphp
				<div id="navbar-collapse-02" class="navbar-collapse collapse">
					
					<!-- begin nav -->
					
					<div class="nav navbar-nav navbar-login-menu" style="margin: 5px;">
						@include('auth.btn-login-shopping')
					</div>
					<ul class="nav navbar-nav text-right">

						<li><a href="{!! route('home') !!}">INICIO</a></li>
						<li><a href="{!! route('quienes-somos') !!}">QUIENES SOMOS</a></li>
						<li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle">PRODUCTOS</a>
						  <ul role="menu" class="dropdown-menu">
							@if(isset($categorias))
							@foreach($categorias as $c)
							<li><a href="{!! route('productos', [$c->url]) !!}">{!! $c->nombre !!}</a></li>
							<li class="divider"></li>
							@endforeach
							@endif
						  </ul>
						</li>
						<li><a href="{!! route('contacta-con-nosotros') !!}" class="menu-last">CONTACTO</a></li>
							
						@if(Auth::check())
							<li class="dropdown">
								<a href="#" data-toggle="dropdown" class="dropdown-toggle">
									<span class="btn-li-user"><i class="fa fa-user fa-lg" aria-hidden="true"></i> {{ Auth::user()->nombre }}</span>
								</a>
								<ul role="menu" class="dropdown-menu">
									<li><a href="{!! route('cuenta.userpersonal') !!}">Mi Cuenta</a></li>
									<li><a href="{!! route('cuenta.orders') !!}">Mis Compras</a></li>
									<li><a href="{!! route('password.new') !!}">Cambiar Contraseña</a></li>
									<li>
										<a class="dropdown-item" href="{{ route('logout') }}"
										onclick="event.preventDefault();
														document.getElementById('logout-form').submit();">
											{{ __('Logout') }}
										</a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											@csrf
										</form>
									</li>
									<li class="divider"></li>
								</ul>
							</li>
						@endif

				
					</ul>
					<!-- end nav -->

				</div>
				<!-- end navbar -->

			</div>
			<!-- end container -->

		</div>
		<!-- end navbar -->
			
	</header>
	<!--end header -->





@yield('content')

<div id="overlay">
	<div class="cv-spinner">
		<span class="spinner"></span>
	</div>
</div>




	<!--begin footer -->
	<div class="footer">
			
		<!--begin container -->
		<div class="container">
		
			<!--begin row -->
			<div class="row footer-top" style="padding-bottom: 15px">
			
				<!--begin col-md-4 -->
				<div class="col-md-4 padding-bottom-50">
				
					<!-- <h4>NOSOTROS</h4> -->
					
					<!-- <p class="margin-bottom-20">Somos una empresa dedicada a la fabricación de productos con PVC.</p> -->

					<a href="{!! route('quienes-somos') !!}" class="btn-sm btn-green">Más información</a>
										
				</div>
				<!--end col-md-4 -->
				
				<!--begin col-md-4 -->
				<div class="col-md-4 padding-bottom-50">
				
					{{--
					<h4>DESCARGAS</h4>
					
					<ul class="footer-list">
						<li class="first"><a href="{!! asset('public/pdfs/catalogo.pdf') !!}" target="_blank">Catálogo en PDF</a></li>
						
					</ul>
					--}}
					
				</div>
				<!--end col-md-4 -->
				
				<!--begin col-md-4 -->
				<div class="col-md-4 padding-bottom-50">
				
					<h4>DETALLES DE CONTACTO</h4>
					
					<p>Contacta con nosotros hoy!</p>

					<p class="contact_info"><i class="icon icon-pin-map"></i> Av. Alfredo Mendiola 5805, Lima, Perú</p>
					
					<p class="contact_info"><i class="icon icon-email-envelope"></i> ventas@omega.com</p>
					
					<p class="contact_info"><i class="icon icon-call-phone"></i> (+511) 528 1261</p>
				
				</div>
				<!--end col-md-4 -->
				
				<!--begin col-md-12 
				<div class="col-md-12">
					
					<div class="col-xs-12 col-md-4 col-md-offset-4 text-center">
						<img src="{{ asset('public/images/iso-9001.png') }}?v=1">
						<img src="{{ asset('public/images/iso-14001.png') }}?v=1">
					</div>
				</div>-->
				
			</div>
			<!--end row -->
			
			<!--begin row -->
			<div class="row">
				
				<!--begin footer-bottom -->
				<div class="footer-bottom">
				
					<!--begin text-center -->
					<div class="text-center">

						<p>© {!! date('Y') !!} Todos los derechos reservados.</a></p>
						
					</div>
					<!--end text-center -->
						
				</div>
				<!--end footer-bottom -->
						
			</div>
			<!--end row -->
			
		</div>
		<!--end container -->
				
	</div>
	<!--end footer -->
	<link rel='stylesheet' id='camera-css'  href='{{ URL::asset('public/camera/css/camera.css') }}' type='text/css' media='all'> 
	<!--<script type='text/javascript' src='{{ URL::asset('public/camera/scripts/jquery.min.js') }}'></script>-->


	<!-- Load JS here for greater good =============================-->
	<script src="{{ URL::asset('public/js/jquery-1.11.3.min.js') }}"></script>
	<script type='text/javascript' src="{{ URL::asset('public/camera/scripts/jquery.mobile.customized.min.js') }}"></script>
	<script type='text/javascript' src="{{ URL::asset('public/camera/scripts/jquery.easing.1.3.js') }}"></script> 
	<script type='text/javascript' src="{{ URL::asset('public/camera/scripts/camera.min.js') }}"></script> 

	@include('auth.login-register')
	<script>
		var url_site='{{url("/")}}';
		
	</script>

	<script src="{{ URL::asset('public/js/bootstrap.min.js') }}"></script>
	<script src="{{ URL::asset('public/js/jquery.scrollTo-min.js') }}"></script>
	<script src="{{ URL::asset('public/js/jquery.magnific-popup.min.js') }}"></script>
	<script src="{{ URL::asset('public/js/plugins.js') }}"></script>
	<script src="{{ URL::asset('public/js/bootoast.min.js') }}"></script>
	<script src="{{ URL::asset('public/js/select2.min.js') }}"></script>
	<script src="{{ URL::asset('public/js/custom.js') }}"></script>
	<script src="{{ URL::asset('public/js/auth/login.register.js') }}"></script>

	@yield('scripts')

</body></html>