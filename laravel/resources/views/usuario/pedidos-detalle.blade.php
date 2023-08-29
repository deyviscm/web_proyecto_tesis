@extends('app')
@section('style')
<style>
	.cart-form{
		border-radius: 10px !important;
		border-color: #dfdfdf !important;
	}
	.cart-heading{
		color: #000 !important;
		font-weight: 700;
		font-size: 15px;
	}
	/*  */
	.css-cart{
		text-align: center;
	}
	.btn-rp{
		border-radius: 25px;
	}
	.form-cart{
		color: #000;
		font-size: 14px;
		font-family: Lato,sans-serif;
	}
	.form-cart .form-group{
		padding: 0px 5px;
	}
	.css-h-form{
		margin-bottom: 10px;
		padding: 0 5px;
	}
	.select2-selection{
		height: 34px !important;

	}
	.select2-selection__rendered{
		height: 34px;
		padding-top: 2px;
	}
	.select2-container{
		width: 100% !important;
	}
	.cart-form-list{
		border: 1px solid #cfcbcb;
		border-left-width: 5px;
		border-radius: 10px !important;
	}
	.border-bottom{
		border-bottom: 1px solid rgb(224, 224, 224);
	}

	.css-compra{
		display: flex;
		flex-direction: column;
	}
	.css-compra span{
		padding: 5px 0px;
	}


	.css-dt{
		font-size: 18px;
		line-height: 30px;
	}
	.css-flex{
		display: flex;
	}
	.css-flex-row{
		flex-direction: row;
	}
	.css-flex-column{
		flex-direction: column;
	}
	.css-flex-between{
		justify-content: space-between;
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
				
					<h2 class="page-title white">DETALLE DE LA COMPRA</h2>
					
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
				<form class="pedidos-user" method="post">
					<input type="hidden" name="_token" value="{!! csrf_token() !!}">
					<div class="col-md-12 margin-bottom-5">
						<div class="panel panel-default cart-form">
							<div class="panel-body form-cart">
								<div class="col-md-12">
									<div class="css-flex css-flex-row css-flex-between">
										<div class="css-dt">
											<strong><a href="{!! route('cuenta.orders') !!}" style="color: #2F362F;" data-toggle="tooltip" title="Mis Compras"><i class="fa fa-arrow-left" aria-hidden="true"></i></a> Detalle de la compra</strong>
										</div>
										<div class="css-flex css-flex-column text-right">
											<strong>Total Compra</strong>
											<span>{{$ordenPedido->simbolo}} {{$ordenPedido->total}}</span>
										</div>
										<div class="css-flex css-flex-column text-right">
											<strong>Fecha Compra</strong>
											<span>{{$ordenPedido->fecha_compra}}</span>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>

					<div class="col-md-12 margin-bottom-5">
						<div class="panel panel-default cart-form-list">
							<div class="panel-body form-cart padding-top-10">
								<div class="col-md-12">
									<div class="col-sm-4">
										<div class="css-flex css-flex-column">
											<span class="margin-bottom-10"><strong>Compras:</strong> Nº {{$ordenPedido->nro_orden}}</span>
											<span class="margin-bottom-10"><strong>Estado:</strong> {{$ordenPedido->desc_estado}}</span>
											<span class="margin-bottom-10"><strong>Cantidad Productos:</strong> {{$ordenPedido->total_productos}}</span>
											<span class="margin-bottom-10"><strong>Total:</strong> {{$ordenPedido->simbolo}} {{number_format($ordenPedido->total,2)}}</span>
										</div>
									</div>
									<div class="col-sm-8">
										<div class="css-flex css-flex-column">
											<span class="margin-bottom-10"><strong>Dirección:</strong>{{$direccion->descripcion}}</span>
											<span class="margin-bottom-10"><strong>Calle:</strong> {{$ordenPedido->calle_direccion}}</span>
											<span class="margin-bottom-10"><strong>Número:</strong> {{$ordenPedido->numero_direccion}}</span>
											<span class="margin-bottom-10"><strong>Referencia:</strong> {{$ordenPedido->referencia_direccion}}</span>
										</div>
									</div>
								</div>

							</div>
						</div>	
					</div>

					<div class="col-md-12 margin-bottom-5">
						<div class="panel panel-default cart-form-list">
							<div class="panel-body form-cart padding-top-10">
								@foreach($ordenPedidoDetalle as $key => $row)
									<div class="lt-productos">
										<div class="lt-imagen">
											<img src="{!! asset('public/images/productos/'.$row->url_producto) !!}" class="" alt="Responsive image">
										</div>
										<div class="lt-detalle">
											<div class="lt-header">
												<span>{{$row->producto}}</span>
											</div>
											<div class="lt-body">
												<div class="lt-pu">
													<span>Precio Unitario {{$row->moneda_simbolo}} {{$row->precio_unitario}}</span>
												</div>
												<div class="lt-opt row-producto">
													<span class="rw-cantidad">Cantidad: {{$row->cantidad}}</span>
													<span class="rw-moneda">Total: {{$row->moneda_simbolo}}</span>
													<span class="rw-precio">{{number_format($row->total,2)}}</span>
												</div>
											</div>
										</div>
									</div>
								@endforeach
							</div>
						</div>	
					</div>

					<div class="col-md-12 margin-bottom-5">
						<div class="panel panel-default cart-form-list">
							<div class="panel-body form-cart padding-top-10">
								<div class="col-md-12">
									<div class="css-flex css-flex-column">
										<div class="margin-bottom-10" style="font-size:15px;"><strong>Detalle de pago</strong></div>
										<div class="css-flex css-flex-column">
											<span><strong>Medio de Pago</strong> :{{$ordenPedido->tipo_pago_desc}}</span>
										</div>
									</div>
								</div>

							</div>
						</div>	
					</div>

				</form>
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
	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip()
	});
</script>
@endsection