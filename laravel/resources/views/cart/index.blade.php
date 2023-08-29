@extends('app')
@section('style')
<style>
	.cart-productos{
		border-radius: 15px !important;
    	border-color: #dfdfdf !important;
	}
	.cart-heading{
		/* text-align: center; */
		color: #000 !important;
		font-weight: 700;
		font-size: 15px;
		padding: 10px 15px;
	}
	.lt-productos{
		display:flex;
		margin-bottom: 10px;
	}
	.lt-productos .lt-imagen{
		margin: 0 3px 0 3px;
		outline: none;
		width: 100px;
		height: 100px;
		position: relative;
		padding: 0;
		border: 1px solid #c1c1c1;
		display: inline-block;
		line-height: 95px;
		min-width: 100px;
	}
	.lt-productos .lt-imagen img{
		max-width: 100%;
    	height: auto;
	}
	.lt-productos .lt-detalle{
		flex: auto;
	}
	.lt-productos .lt-detalle .lt-header{
		font-weight: 600;
		font-size: 14px;
    	color: #000000;
		margin: 5px;
	}
	.lt-productos .lt-body .lt-opt{
		line-height: 30px;
		/* height: 25px; */
		display: flex;
	}
	.lt-productos .lt-body .lt-opt span{
		margin:5px;
		color: #003059;
	}
	.lt-productos .lt-body .lt-opt span .fa{
		/* padding: 2px; */
    	cursor: pointer;
		font-size: 25px;
	}

	.lt-productos .lt-body .lt-pu{
		margin: 2px 5px;
		font-size: 12px;
		color: black;
		font-weight: 600;
	}
	.lt-opt .rw-cantidad{
		width: 20px;
    	text-align: center;
		font-weight: 600;
	}
	.lt-opt .rw-moneda{
		margin-left: auto !important;
		width: 20px;
    	text-align: center;
		font-weight: 600;
	}
	.lt-opt .rw-precio{
		width: 60px;
		text-align: right;
		font-weight: 600;
	}
	.p-detalle .list-group-item{
		border: none;
		/* border-right: none;
    	border-left: none; */
	}
	.str-detalle{
		font-weight: 600;
		color: #000;
		font-size: 15px;
	}
	.str-cnt{
		float: right;
		color: #000;
		width: 65px;
		text-align: right;
	}
	.str-total{
		font-weight: 600;
	}
	/*  */
	.css-cart{
		text-align: center;
	}
	.css-shopping{
		font-size: 12em;
	}
	.btn-css{
		background: #003059;
	}
	.btn-rp{
		border-radius: 25px;
	}
	.btn-invitado{
		border-radius: 25px;
	}
	.cl-black{
		color: #000;
	}
	.form-cart-cliente .form-group{
		padding: 0px 5px;
	}
	.css-h-form{
		margin-bottom: 10px;
		padding: 0 5px;
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
				
					<h2 class="page-title white">CARRITO DE COMPRA</h2>
					
				</div>
				<!--end col-xs-6 -->

			</div>
			<!--end row -->
			
		</div>
		<!--end container -->
		
	</div>
	<!--end breadcrumb-wrapper-->
	
	<!--begin blog -->
	<section class="section-white small-padding">
		
		<!--begin container-->
		<div class="container cart">

			<!--begin row-->
			<div class="row">

				<!--begin col-sm-6 -->
				@if(count($productos) == 0)
					<div class="col-sm-12 margin-bottom-50">
						<div class="css-cart">
							<div class="css-shopping">
								<span><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
							</div>
							<div class="css-title">
								<h2>Tu Carro está vacío</h2>
							</div>
							<div class="css-body">
								<a href="{!! route('productos', [$categorias[0]->url]) !!}" class="btn btn-sm btn-primary btn-css">VOLVER A LA TIENDA</a>
							</div>
						</div>
					</div>
				@else
					<div class="col-md-8">
						<div class="panel panel-default cart-productos">
							<div class="panel-heading cart-heading">CARRO ({{$totales['total_quantity']}} productos)</div>
							<div class="panel-body">
								@foreach($productos as $key => $row)
									<div class="lt-productos">
										<div class="lt-imagen">
											<img src="{!! asset('public/images/productos/'.$row->url_producto) !!}" class="" alt="Responsive image">
										</div>
										<div class="lt-detalle">
											<div class="lt-header">
												<span>{{$row->titulo}}</span>
											</div>
											<div class="lt-body">
												<div class="lt-pu">
													<span>Precio Unitario {{$row->moneda_simbolo}} {{$row->precio_unitario}}</span>
												</div>
												<div class="lt-opt row-producto-{{$row->id}}" data>
													<span><i class="fa fa-minus-circle fa-lg minus-product" aria-hidden="true" data-id="{{$row->id}}"></i></span>
													<span class="rw-cantidad">{{$row->quantity}}</span>
													<span><i class="fa fa-plus-circle fa-lg plus-product" data-id="{{$row->id}}" aria-hidden="true" ></i></span>
													<span class="rw-moneda">{{$row->moneda_simbolo}}</span>
													<span class="rw-precio">{{number_format(($row->precio_unitario * $row->quantity), 2)}}</span>
													<span><i class="fa fa-trash remove-product" aria-hidden="true" data-id="{{$row->id}}"></i></span>
												</div>
												<div class="lt-precio">
												</div>
											</div>
										</div>
									</div>
								@endforeach
							</div>
						</div>
					</div>
					
					<div class="col-md-4 margin-bottom-50">
						<div class="panel panel-default cart-productos">
							<div class="panel-heading cart-heading">RESUMEN DE LA ORDEN</div>
							<div class="panel-body form-cart-cliente">
								
								<ul class="list-group p-detalle">
									<li class="list-group-item">
										<span class="str-detalle str-subtotal">Subtotal ({{$totales['total_quantity']}} productos)</span>
										<span class="str-cnt">{{number_format($totales['sub_total'],2)}}</span>
										<span class="str-cnt">S/</span>
									</li>
									<li class="list-group-item">
										<span class="str-detalle">Envío</span>
										<span class="str-cnt str-envio">{{number_format($totales['envio_domicilio']->getValue(), 2)}}</span>
										<span class="str-cnt">S/</span>
									</li>
									<li class="list-group-item">
										<span class="str-detalle">Total</span>
										<span class="str-cnt str-total">{{number_format($totales['total'],2)}}</span>
										<span class="str-cnt str-total">S/</span>
									</li>
								</ul>
								<div class="col-md-12">
									<button type="button" class="btn btn-primary btn-lg btn-block btn-css btn-rp" style="margin-left: 0;">Realizar Pedido</button>
									@if($tipo_user == 'INVITADO')
									<a href="{{ route('checkout.index') }}" class="btn btn-danger btn-lg btn-block btn-invitado" style="margin-left: 0;">Pedido como Invitado</a>
									@endif
								</div>
							</div>
						</div>
					</div>
				@endif
				<!--end col-sm-6-->
			 
			</div>
			<!--end row-->
	
		</div>
		<!--end container-->
	
	</section>
	<!--end blog -->

@endsection
@section("scripts")
<script>
	$('.plus-product').on("click", function(){
		var dataId = $(this).attr("data-id");
		var cantidad = parseInt($(this).parents('.row-producto-'+dataId).find('.rw-cantidad').html());
		cantidad += 1;
		$(this).attr("disabled", true);
		$.ajax({
			url: url_site+'/cart/update',
			data: {id_producto: dataId, cantidad: cantidad},
			type: "POST",
			success: function (data) {
				if (data.success) {
					location.reload();
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
				$(this).attr("disabled", false);
			}
		});
	});

	$('.minus-product').on("click", function(){
		var dataId = $(this).attr("data-id");
		var cantidad = parseInt($(this).parents('.row-producto-'+dataId).find('.rw-cantidad').html());
		cantidad -= 1;
		$(this).attr("disabled", true);
		$.ajax({
			url: url_site+'/cart/update',
			data: {id_producto: dataId, cantidad: cantidad},
			type: "POST",
			success: function (data) {
				if (data.success) {
					location.reload();
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
				$(this).attr("disabled", false);
			}
		});
	});

	$('.remove-product').on("click", function(){
		var dataId = $(this).attr("data-id");
		$(this).attr("disabled", true);
		$.ajax({
			url: url_site+'/cart/delete',
			data: {id_producto: dataId},
			type: "POST",
			success: function (data) {
				if (data.success) {
					location.reload();
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
				$(this).attr("disabled", false);
			}
		});
	});

	$('.btn-rp').on("click", function(){
		$(this).attr("disabled", true);
		$.ajax({
			url: url_site+'/cart/orders',
			data: {},
			type: "POST",
			success: function (data) {
				if (data.success) {
					// window.location.href = url_site+'/'+data.path;
					window.location = url_site+'/'+data.path;
				}else{
					$('#modal-login').modal('show');
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
				$('.btn-rp').attr("disabled", false);
			}
		});
	});
</script>
@endsection