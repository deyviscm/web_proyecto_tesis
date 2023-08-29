@extends('app')

@section('style')
<style>
	.pd-detalle {
		margin-bottom: 65px;
	}
	.carousel-indicators{
		position: absolute;
		bottom: 10px;
		left: 50%;
		z-index: 15;
		width: 60%;
		padding-left: 0;
		margin-left: -30%;
		text-align: center;
		list-style: none;
	}
	#carousel-producto a .fa-chevron-left{
		position: absolute;
		top: 50%;
		z-index: 5;
		display: inline-block;
		margin-top: -10px;
	}

	#carousel-producto a .fa-chevron-right{
		position: absolute;
		top: 50%;
		z-index: 5;
		display: inline-block;
		margin-top: -10px;
	}
	#carousel-producto .list-btn-img{
		width: 100% !important;
		left: auto;
	}
	#carousel-producto .list-btn-img.carousel-indicators .active {
		margin: 0 3px 0 3px;
		outline: none;
		height: 45px;
		width: auto;
		position: relative;
		padding: 0;
	}
	.btn-image-p{
		margin: 0 3px 0 3px;
		outline: none;
		height: 45px;
		position: relative;
		padding: 0;
		border: 1px solid #c1c1c1;
		display: inline-block;
		cursor: pointer;
	}
	.btn-image-p img{
		height: 100%;
    	width: auto;
	}
	.service-inner-big{
		padding: 0px;
	}
	.carousel-inner .item{
		/* text-align: center;
    margin: 0 auto 12px auto;
    position: relative;
    overflow: hidden; */
    /* min-height: 410px;
    max-height: 485px;
    max-width: 485px; */
	}
	.carousel-inner .item img{
		/* max-width: 400px;
		margin-top: auto;
		margin-bottom: auto;
		transform: translate(0%, 50%); */
	}
	.btn-carrito{
		display: flex;
	}
	.btn-carrito .txt-precio{
		line-height: 20px;
		padding: 10px 20px;
		margin: 10px 10px 10px 0;
		font-size: 25px;
    	font-weight: 700;
	}
	.btn-carrito button{
		padding: 5px 20px;
	}
	.item-precio-r{
		height: 35px;
		overflow: hidden;
		line-height: 35px;
		font-weight: 600;
		font-size: 20px;
	}
	.css-title-p {
		font-size: 14px !important;
		color: #003059 !important;
		font-weight: 600 !important;
	}
	.css-ctg{
		font-size: 14px !important;
		color: #003059 !important;
		font-weight: 600 !important;
	}
	
</style>
@endsection
@section('content')
	<!--begin breadcrumb-wrapper-->
	<div class="breadcrumb-wrapper">

		<div class="breadcrumb-wrapper-overlay"></div>
	
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
	<section class="section-white padding-top-50 padding-bottom-50">
		
		<!--begin container-->
		<div class="container">
			<!--begin row-->
			<div class="row">
				<div class="col-md-12">
					<div class="d-flex flex-row css-title-p padding-bottom-20">
						<span><a href="{!! route('productos', [$categoria->url]) !!}" class="css-ctg"><i class="fa fa-arrow-left" aria-hidden="true"></i> {!! $categoria->nombre !!}</a></span>
						<span> / </span>
						<span>{!! $producto->titulo !!}</span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5 col-sm-12 col-xs-12 pd-detalle">
					<div id="carousel-producto" class="carousel slide" data-ride="carousel" data-interval="false">
						<!-- <div class="col-md-12"> -->
							<div class="carousel-inner" role="listbox">
								@foreach($imagenes as $key => $row)
									@php
									$active = ($key == 0) ? 'active' : '';
									@endphp
									<div class="item {{$active}}">
										<img src="{!! asset('public/images/productos/'.$row->url) !!}" class="">
										<div class="carousel-caption">
										</div>
									</div>
								@endforeach
								<!-- <div class="item active">
									<img alt="Second slide [900x500]" src="{!! asset('public/images/productos/'.$producto->imagen) !!}" class="">
									<div class="carousel-caption">
									</div>
								</div> -->
							</div>

							<a class="left carousel-control" href="#carousel-producto" role="button" data-slide="prev">
								<i class="fa fa-chevron-left" aria-hidden="true"></i>
								<span class="sr-only">Previous</span>
							</a>
							<a class="right carousel-control" href="#carousel-producto" role="button" data-slide="next">
								<i class="fa fa-chevron-right" aria-hidden="true"></i>
								<span class="sr-only">Next</span>
							</a>
						<!-- </div> -->
						<div class="col-md-12">
							<div class="list-btn-img carousel-indicators">
								@foreach($imagenes as $key => $row)
									@php
									$active = ($key == 0) ? 'active' : '';
									@endphp
									<div class="btn-image-p" data-target="#carousel-producto" data-slide-to="{{$key}}" class="{{$active}}">
										<img src="{!! asset('public/images/productos/'.$row->url) !!}" class="img-responsive" alt="Responsive image">
									</div>
								@endforeach
								<!-- <div class="btn-image-p" data-target="#carousel-producto" data-slide-to="0" class="active">
									<img src="{!! asset('public/images/productos/'.$producto->imagen) !!}" class="img-responsive" alt="Responsive image">
								</div> -->
							</div>
						</div>
					</div>

				</div>
				<div class="col-md-7 col-sm-12 col-xs-12">
					<div class="col-md-12">
						<h3 style="color: #000;">{!! $producto->titulo !!}</h3>

						<p>{!! nl2br($producto->descripcion) !!}</p>
						<p style="color: #000;font-weight: 700;"><i class="fa fa-truck fa-lg" aria-hidden="true" style="color: black;"></i></i> <span style="margin-left: 8px;">Envío Programado</span></p>
						<p style="color: #000;font-weight: 700;"><i class="fa fa-home fa-lg" aria-hidden="true" style="color: black;"></i><span style="margin-left: 8px;">Recojo en tienda</span></p>

						<p  class="item-btn-producto">
							@php
								$accion = 1;
								$btn_text = '¡Cotizar!';
								if(!is_null($producto->precio_unitario) && $producto->precio_unitario != '' && $producto->estado_precio){
									$accion = 2;
									$btn_text = 'Agregar al Carrito';
								}
							@endphp
							<div class="btn-carrito">
								@if($accion == 2)
									<div class="txt-precio">{{$producto->moneda_simbolo .' '. $producto->precio_unitario}}</div>
									<div><button class="btn-sm btn-success btn-agregar btn-css" onclick="addCart({{$producto->id}},'{{$accion}}')">{{$btn_text}}</button></div>
								@else
									@php
										$url = 'https://api.whatsapp.com/send?phone=51998168584&text=Deseo información del producto '.$producto->titulo;
									@endphp
									<div><a class="btn-sm btn-success btn-agregar btn-css" href="{{$url}}" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i> {{$btn_text}}</a></div>
								@endif
							</div>
						</p>
					</div>
					<div class="col-md-12 newsletter_info3">
						<div class="col-md-6">
							<h4>¿Alguna pregunta?</h4>

							<p>Puedes llamarnos sin ningún compromiso y resolveremos todas tus dudas.</p>
						</div>
						<div class="col-md-6">							
							<div class="newsletter-box">
								
								<i class="icon icon-call-phone"></i>

								<p>Comunícate con nosotros</p>

								<span>(+511) 528 1261</span>

							</div>
						</div>
					</div>
				</div>
			</div>

			<!--end row-->

			<div class="margin-bottom-90 margin-top-90">

				<h4 class="text-center">PRODUCTOS RELACIONADOS</h4>

			</div>

			<!--begin row-->
			<div class="row">

				<!--begin col-sm-6 -->
				<div class="margin-bottom-50">
					
				<!--begin portfolio-items-->
				<ul class="portfolio-items list-unstyled" id="grid">
		  
					@foreach($productos as $p)
					
					<!--begin team-item -->
					<li class="col-md-3 col-sm-3 col-xs-12 team-item-white">

						<figure class="portfolio-item">

							<a href="{!! route('producto-detalle', [$categoria->url, $p->url]) !!}">

								<img src="{{ URL::asset('public/images/productos/'.$p->imagen) }}" class="team-img-sm" alt="pic">

							</a>

							<h3 style="height: 75px; overflow:hidden">{{ $p->titulo }}</h3>
							

							<!-- <p style="height: 45px; overflow:hidden">{{ str_limit($p->descripcion, 70) }}</p> -->
							<p class="item-precio-r">
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
							<a href="{!! route('producto-detalle', [$categoria->url, $p->url]) !!}" class="btn-sm btn-primary btn-css">{{ $btn_text }}</a>

						</figure>
						
					</li>
					<!--end team-item -->
					
					@endforeach

				</ul>
				<!--end portfolio-items-->

				</div>
				<!--end col-sm-6-->
			 
			</div>
			<!--end row-->
	
		</div>
		<!--end container-->
	
	</section>
	<!--end blog -->
	<div id="md-add-product" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Compra Online</h4>
			</div>
			<div class="modal-body">
				<p>Producto añadido al carrito de compras.</p>
			</div>
			<div class="modal-footer">
				<a href="{!! route('producto-detalle', [$categoria->url, $producto->url]) !!}" class="btn btn-default btn-sm" style="margin: 0 5px;">Seguir Comprando</button>
				<a href="{!! route('cart.index') !!}" class="btn btn-sm btn-primary btn-css" style="margin: 0 5px;">Pagar</a>
			</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')
<script>
	function addCart(idProducto, tipo){
		var params = {'id_producto' : idProducto}
		if(tipo == 2){
			$('.btn-agregar').attr('disabled',true);
			$.ajax({
				url: url_site+'/cart/add',
				data: params,
				type: "POST",
				success: function (data) {
					if(data.success){
						$('#md-add-product').modal('show');
						// bootoast.toast({
						// 	message: data.message,
						// 	type: 'success',
						// 	position: 'right-top',
						// 	icon: undefined,
						// 	animationDuration: "300",
						// 	dismissible: true
						// });
					}
				},error: function (data) {
					bootoast.toast({
						message: "No esta disponible en este momento. Por favor, intenta de nuevo en 5 minutos.",
						type: 'danger',
						position: 'right-top',
						icon: undefined,
						animationDuration: "300",
						dismissible: true
					});
				},complete: function(data){
					$('.btn-agregar').attr('disabled',false);
				}
			});
		}
	}
</script>
@endsection