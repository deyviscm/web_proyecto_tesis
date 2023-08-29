@extends('app')

@section('style')
<style>
	.affix {
		top: 30px;
	}
	@media (min-width: 991px){
		.op-menu{
			display:none;
		}
	}
	@media (max-width: 991px){
		.header-productos{
			margin: 15px 11px 0px 0px !important;
			z-index: 1 !important;
			width: 100% !important;
			padding: 8px !important;
		}

		.header-productos .navbar-default{
			min-height: 0px;
		}
		.nv-menu-prod {
			display: none;
		}
	}
	#menu-pd
	{
		font-family: Roboto,sans-serif;
		min-width: 225px;
	}
	#menu-pd .active-item{
		font-weight: 700;
	}
	#menu-pd a.active{
		background: #007e35;
	}
	.portfolio-items .item-titulo{
		height: 70px;
		overflow:hidden;
		font-size: 14px;
	}
	.portfolio-items .item-precio{
		height: 35px;
		overflow: hidden;
		font-size: 17px;
		font-weight: 600;
		margin: 10px 0px 0px 0px;
		color: #24A52F;
	}
	.portfolio-item .btn-sm{
		padding: 8px 20px;
   	 	margin: 5px 10px;
	}
	.navbar-btn .btn{
		margin:0px;
	}
	.body-productos{
		z-index: 0;
	}
	.portfolio-item:hover{
		visibility: visible;
		/* opacity: 1; */
		transition: opacity .3s ease,visibility 0s ease,-webkit-transform .3s ease;
		transition: opacity .3s ease,visibility 0s ease,transform .3s ease;
		transition: opacity .3s ease,visibility 0s ease,transform .3s ease,-webkit-transform .3s ease;
		/* -webkit-transform: scale(1); */
		/* transform: scale(1); */
		box-shadow: 0 0 10px rgba(0,0,0,.15);
		transform: scale(.98);
	}
</style>
@endsection

@section('content')
	<!--begin breadcrumb-wrapper-->
	<div class="breadcrumb-wrapper-prod">

		<div class="breadcrumb-wrapper-overlay-prod"></div>
	
		<!--begin container -->
		<div class="container">
			
			<!--begin row -->
			<div class="row">
				  
				<!--begin col-xs-6 -->
				<div class="col-xs-6">
				
					<h2 class="page-title white">{!! $categoria->nombre !!}</h2>
					
				</div>
				<!--end col-xs-6 -->

			</div>
			<!--end row -->
			
		</div>
		<!--end container -->
		
	</div>
	<!--end breadcrumb-wrapper-->

	
	<!--begin blog -->
	<!-- <section class="section-white small-padding"> -->
		
		<!--begin container-->
		<div class="container">

			<!--begin row-->
			<div class="row">
				<!-- <div class="col-md-12">
				</div> -->
				<div class="col-md-12 op-menu">
					<div class="navbar-btn nav nav-pills nav-stacked" data-spy="affix" data-offset-top="240" style="z-index: 2;margin: 0px;top: 0px;">
						<div class="btn-group btn-group-justified" role="group" aria-label="...">
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-default" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">Categorias</button>
							</div>
							<!-- <div class="btn-group" role="group">
								<button type="button" class="btn btn-default">Middle</button>
							</div>
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-default">Right</button>
							</div> -->
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="header-productos nav nav-pills nav-stacked" data-spy="affix" data-offset-top="240" style="margin-top: 15px;">
						<nav class="navbar navbar-default">
							<div class="container-fluid">
								<!-- <div class="navbar-header nv-menu-prod" >
									<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
								</div> -->
								<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
									<div id="menu-pd">
										<div class="panel list-group">
											<a href="#" class="list-group-item slide active" data-toggle="collapse" data-target="#sm" data-parent="#menu-pd">CATEGORIAS</a>
											<div id="sm" class="sublinks collapse in"><!-- in -->
												@if(isset($categorias))
												@foreach($categorias as $c)
													<a  href="{!! route('productos', [$c->url]) !!}"  class="{{ (request()->is('productos/'.$c->url)) ? 'active-item' : '' }} list-group-item small"><i class="fa fa-caret-right" aria-hidden="true"></i> {!! $c->nombre !!}</a>
												@endforeach
												@endif
											</div>
										</div>
									</div>
								</div>
							</div>
						</nav>
					</div>

					
				</div>

				<div class="col-md-9 body-productos">
					<!--begin col-sm-6 -->
					<div class="margin-bottom-50">
						<!--begin portfolio-items-->
						<ul class="portfolio-items list-unstyled" id="grid">
				
							@foreach($productos as $p)
							<!--begin team-item -->
							<li class="col-md-4 col-sm-4 col-xs-12 team-item-white">
		
								<figure class="portfolio-item">
		
									<a href="{!! route('producto-detalle', [$categoria->url, $p->url]) !!}" style="height: 300px;/* width: 100%; */display: block;line-height: 300px;">
										<img src="{{ URL::asset('public/images/productos/'.$p->imagen) }}" class="team-img-sm" alt="pic">
									</a>
		
									<h3 class="item-titulo">{{ $p->titulo }}</h3>
									<p  class="item-precio">
										@php
											$btn_text = '¡Cotizar!'
										@endphp
										@if($p->precio_unitario != '')
											{{ $p->moneda_simbolo .' '. $p->precio_unitario }}
											@php
												$btn_text = 'Comprar'
											@endphp
										@endif
									</p>
		
									<a href="{!! route('producto-detalle', [$categoria->url, $p->url]) !!}" class="btn-sm btn-success btn-css">{{$btn_text}}</a>
		
								</figure>
								
							</li>
							<!--end team-item -->
							
							@endforeach
		
						</ul>
					</div>
					<!--end portfolio-items-->

				</div>
				<!--end col-sm-6-->
			 
			</div>
			<!--end row-->
			 
			<!--begin row-->
			<div class="row">

				<div class="text-center">

					{!! $productos->links() !!}

				</div>
			</div>
			<!--end row-->
	
		</div>
		<!--end container-->
	
	<!-- </section> -->
	<!--end blog -->

@endsection

@section('scripts')

@endsection