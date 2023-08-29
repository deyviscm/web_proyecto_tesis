@extends('app')
@section('style')
<style>
	
	.cart-productos{
		border-radius: 15px !important;
    	border-color: #dfdfdf !important;
	}
	.cart-heading{
		color: #000 !important;
		font-weight: 700;
		font-size: 15px;
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
		/* width: 20px; */
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
		border-right: none;
    	border-left: none;
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
	.select2-selection{
		height: 34px !important;

	}
	.select2-selection__rendered{
		height: 34px;
    	padding-top: 2px;
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
								<a href="{!! route('productos', ['conexiones-de-agua']) !!}" class="btn btn-sm btn-primary btn-css">VOLVER A LA TIENDA</a>
							</div>
						</div>
					</div>
				@else
				<form class="enviar-pedido" action="{!! route('checkout.save') !!}" method="post" enctype="multipart/form-data">
					
					<input type="hidden" name="_token" value="{!! csrf_token() !!}">
					<div class="col-md-7 margin-bottom-50">
						<div class="panel panel-default cart-productos">
							<div class="panel-body form-cart-cliente">
								<div class="col-sm-12 fr-row">
									<div class="col-sm-12 css-h-form">
										<!-- cliente / invitado -->
										<strong class="text-dark" style="color: #000;">DATOS COMO <?=$tipo_user;?></strong>
									</div>
								</div>
								<div class="col-sm-12 fr-row">
									<div class="form-group col-sm-6">
										<input type="text" class="form-control" name="co_nombre" id="co_nombre" value="{{$cliente['nombre']}}" placeholder="Nombres" <?=$disabled;?> >
									</div>
									<div class="form-group col-sm-6">
										<input type="text" class="form-control" name="co_apellidos" id="co_apellidos" value="{{$cliente['apellidos']}}" placeholder="Apellidos" <?=$disabled;?> >
									</div>
								</div>
								<div class="col-sm-12 fr-row">
									<div class="form-group col-sm-12">
										<input type="text" class="form-control" name="co_empresa" id="co_empresa" value="{{$cliente['empresa']}}" placeholder="Empresa">
									</div>
								</div>
								<div class="col-sm-12 fr-row">
									<div class="form-group col-sm-6">
										<input type="text" class="form-control numeric" name="co_celular" id="co_celular" value="{{$cliente['celular']}}" placeholder="Celular (*)" maxlength="9">
									</div>
									<div class="form-group col-sm-6">
										<input type="text" class="form-control" name="co_email" id="co_email" value="{{$cliente['email']}}" placeholder="Email" <?=$disabled;?> >
									</div>
								</div>
								<div class="col-sm-12 fr-row">
									<div class="col-sm-12 css-h-form">
										<strong class="text-dark" style="color: #000;">DIRECCIÓN</strong>
									</div>
								</div>
								<div class="col-sm-12 fr-row">
									<div class="form-group col-sm-12">
										<!-- <input type="text" class="form-control" name="co_ubigeo" id="co_ubigeo" value="{{$cliente['ubigeo']}}" placeholder="Departamento / Provincia / Distrito"> -->
										<select class="form-control select_ubigeo" name="co_ubigeo" id="co_ubigeo">
											<option value = ''>-- Seleccione --</option>
											@if(isset($ubigeo))
											@foreach($ubigeo as $row)
												@php
												$selected = ($row->ubigeo == $cliente['ubigeo']) ? 'selected' : '';
												@endphp
												<option value="{{$row->ubigeo}}" {{$selected}}>{{$row->descripcion}}</option>
											@endforeach
											@endif
										</select>
									</div>
								</div>
								<div class="col-sm-12 fr-row">
									<div class="form-group col-sm-9">
										<input type="text" class="form-control" name="co_calle_direccion" id="co_calle_direccion" value="{{$cliente['calle_direccion']}}" placeholder="Calle (*)">
									</div>
									<div class="form-group col-sm-3">
										<input type="text" class="form-control" name="co_numero_direccion" id="co_numero_direccion" value="{{$cliente['numero_direccion']}}" placeholder="Número (*)">
									</div>
								</div>
								<div class="col-sm-12 fr-row">
									<div class="form-group col-sm-12">
										<input type="text" class="form-control" name="co_referencia_direccion" id="co_referencia_direccion" value="{{$cliente['referencia_direccion']}}" placeholder="Referencia  (*)">
									</div>
								</div>
								<div class="col-sm-12 fr-row">
									<div class="col-sm-12 css-h-form">
										<strong class="text-dark" style="color: #000;">COMPROBANTE DE PAGO</strong>
									</div>
								</div>
								<div class="col-sm-12 fr-row">
									<div class="form-group col-sm-12 cl-black">
										<label class="radio-inline" >
											<input type="radio" name="co_tipo_comprobante" id="rd-cmp-1" data-toggle="tooltip" title="Ingrese DNI" value="1" checked> Boleta
										</label>
										<label class="radio-inline" >
											<input type="radio" name="co_tipo_comprobante" id="rd-cmp-2" data-toggle="tooltip" title="Ingrese RUC" value="2"> Factura
										</label>
									</div>
									<div class="form-group col-sm-12">
										<input type="text" class="form-control" name="co_nro_documento" id="co_nro_documento" placeholder="DNI / RUC (*)" maxlength="8">
									</div>
								</div>
								<div class="col-sm-12 fr-row">
									<div class="col-sm-12 css-h-form">
										<strong class="text-dark" style="color: #000;">MEDIO DE PAGO</strong>
									</div>
								</div>
								<div class="col-sm-12 fr-row">
									<div class="form-group col-sm-12 cl-black">
										<div class="radio" style="padding: 10px 0px;">
											<label class="pd-5">
												<input type="radio" name="co_tipo_pago" id="co_tipo_pago_1" value="1" onchange="check_cta_bancaria()" checked>
												TRANSFERENCIA BANCARIA
											</label>
										</div>
										
										<div class="col-sm-12 fr-row css_cta_bancaria">
											<h6 style="font-size:12px;"><span style="padding: 5px">Datos Cuenta Bancaria</span></h6>
											<input type="hidden" name="co_cta_id" id="co_cta_id" value="{{$cta_bancaria['id']}}" readonly>
											<div class="form-group col-sm-6">
												<input type="text" class="form-control" name="co_cta_nro_cuenta" id="co_cta_nro_cuenta" value="{{$cta_bancaria['nro_cuenta']}}" data-toggle="tooltip" title="Número de Cuenta" readonly>
											</div>
											<div class="form-group col-sm-6">
												<input type="text" class="form-control" name="co_cta_interbancaria" id="co_cta_interbancaria" value="{{$cta_bancaria['cta_interbancaria']}}" data-toggle="tooltip" title="Cuenta Interbancaria" readonly>
											</div>
											<div class="form-group col-sm-6">
												<input type="text" class="form-control" name="co_cta_titular" id="co_cta_titular" value="{{$cta_bancaria['titular']}}" data-toggle="tooltip" title="Titular" readonly>
											</div>
											<div class="form-group col-sm-6">
												<input type="text" class="form-control" name="co_cta_banco" id="co_cta_banco" value="{{$cta_bancaria['banco']}}" data-toggle="tooltip" title="Banco" readonly>
											</div>
											<div class="form-group col-sm-6">
												<label>Adjuntar imagen</label>
												<input type="file" class="form-control" id="co_img_transferencia" name="co_img_transferencia"/>
											</div>
										</div>

										<div class="" style="padding: 10px 0px;">
											<label class="pd-5">
												<input type="radio" name="co_tipo_pago" id="co_tipo_pago_2" value="2" onchange="check_cta_bancaria()" >
												TARJETA DE DÉBITO / CRÉDITO
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="panel panel-default cart-productos">
							<div class="panel-heading cart-heading">RESUMEN ({{$totales['total_quantity']}} productos)</div>
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
													<!-- <span><i class="fa fa-minus-circle fa-lg minus-product" aria-hidden="true" data-id="{{$row->id}}"></i></span> -->
													<span class="rw-cantidad">Cantidad {{$row->quantity}}</span>
													<!-- <span><i class="fa fa-plus-circle fa-lg plus-product" data-id="{{$row->id}}" aria-hidden="true" ></i></span> -->
													<span class="rw-moneda">{{$row->moneda_simbolo}}</span>
													<span class="rw-precio">{{number_format(($row->precio_unitario * $row->quantity), 2)}}</span>
													<!-- <span><i class="fa fa-trash remove-product" aria-hidden="true" data-id="{{$row->id}}"></i></span> -->
												</div>
												<div class="lt-precio">
												</div>
											</div>
										</div>
									</div>
								@endforeach
								<ul class="list-group p-detalle">
									<li class="list-group-item">
										<span class="str-detalle str-subtotal">Subtotal</span>
										<span class="str-cnt">{{number_format($totales['sub_total'], 2)}}</span>
										<span class="str-cnt">S/</span>
									</li>
									<li class="list-group-item">
										<span class="str-detalle">Envío</span>
										<span class="str-cnt str-envio">{{number_format($totales['envio_domicilio']->getValue(), 2)}}</span>
										<span class="str-cnt">S/</span>
									</li>
									<li class="list-group-item">
										<span class="str-detalle">Total</span>
										<span class="str-cnt str-total">{{number_format($totales['total'], 2)}}</span>
										<span class="str-cnt str-total">S/</span>
									</li>
								</ul>
								<div class="checkbox">
									<label>
										<input type="checkbox" id="terminos_condiciones" name="terminos_condiciones"> Acepto términos y condiciones.
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" id="tratamiento_datos" name="tratamiento_datos"> Tratamiento de datos.
									</label>
								</div>
								<button class="btn btn-primary btn-lg btn-block btn-css btn-rp" type="submit" style="margin-left: 0;">Enviar Pedido</button>
							</div>
						</div>
					</div>
				</form>
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
	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip()
		$('.select_ubigeo').select2({
			minimumResultsForSearch: 20
		});
	});
	$("input[name='co_tipo_comprobante']").change(function(){
		$('#co_nro_documento').val('');
		if($(this).val() == 1){
			$('#co_nro_documento').attr('maxlength', 8);
		}else{
			$('#co_nro_documento').attr('maxlength', 11);
		}
	});

	$("#terminos_condiciones").on('change', function() {
		if ($(this).is(':checked')) {
			$(this).attr('value', 'true');
		} else {
			$(this).attr('value', 'false');
		}
	});
	$("#tratamiento_datos").on('change', function() {
		if ($(this).is(':checked')) {
			$(this).attr('value', 'true');
		} else {
			$(this).attr('value', 'false');
		}
	});
	$('.enviar-pedido').each( function(){
		var form = $(this);;
		form.submit(function(e) {
			// form.parent().find('.errors').html('').hide();
			$('.btn-rp').attr('disabled',true);
			
			if (!e.isDefaultPrevented()) {
				var formData = new FormData(this);
				$.ajax({
					url: this.action,
					data: formData,
					// contentType: 'multipart/form-data',
					contentType: false,
					type: "POST",
					processData: false,
					dataType: "json",
					success: function (data) {
						if (data.success) {
							// location.reload();
							window.location = url_site+'/'+data.path;
						}					
					},error: function (data) {
						var status = data.status;
						// alert(status);
						// console.log(data)
						if (data.status === 422) {
							$.each(data.responseJSON.errors, function (key, value) {
								// $('.register-error').append('<div>' + value + '</div>');
								bootoast.toast({
									message: value,
									type: 'danger',
									position: 'right-top',
									icon: undefined,
									animationDuration: "300",
									dismissible: true
								});
							});
						}
						if(data.status === 500){
							bootoast.toast({
								message: "No esta disponible en este momento. Por favor, intenta de nuevo en 5 minutos.",
								type: 'danger',
								position: 'right-top',
								icon: undefined,
								animationDuration: "300",
								dismissible: true
							});
						}
					},complete: function(data){
						$('.btn-rp').attr('disabled',false);
					}
				});
				e.preventDefault();
			}
		});
	});

	function check_cta_bancaria(){
		if($('#co_tipo_pago_1').is(':checked')){
			$('.css_cta_bancaria').show();
		}else{
			$('#co_img_transferencia').val('');
			$('.css_cta_bancaria').hide();
		}
	}
</script>
@endsection