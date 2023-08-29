@extends('app')
@section('style')
<style>
	
	.cart-cliente{
		border-radius: 15px !important;
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
	.form-cart-cliente{
		color: #000;
		font-size: 12px;
		font-family: Lato,sans-serif;
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
				
					<h2 class="page-title white">DATOS PERSONALES</h2>
					
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
				<form class="update-user" action="{!! route('cuenta.userpersonal') !!}" method="post">
					<input type="hidden" name="_token" value="{!! csrf_token() !!}">
					<div class="col-md-12 margin-bottom-50">
						<div class="panel panel-default cart-cliente">
							<div class="panel-body form-cart-cliente">
								<div class="col-sm-12 fr-row">
									<div class="col-sm-12 css-h-form">
										<strong class="text-dark" style="color: #000;">DATOS PERSONALES</strong>
									</div>
								</div>
								<div class="col-sm-12 fr-row">
									<div class="form-group col-sm-3">
										<label for="css-label">Nombres</label>
										<input type="text" class="form-control" name="co_nombre" id="co_nombre" value="{{$cliente['nombre']}}" placeholder="Nombres">
									</div>
									<div class="form-group col-sm-6">
										<label for="css-label">Apellidos</label>
										<input type="text" class="form-control" name="co_apellidos" id="co_apellidos" value="{{$cliente['apellidos']}}" placeholder="Apellidos">
									</div>
									<div class="form-group col-sm-3">
										<label for="css-label">Celular</label>
										<input type="text" class="form-control numeric" name="co_celular" id="co_celular" value="{{$cliente['celular']}}" placeholder="Celular (*)" maxlength="9">
									</div>
								</div>
								<div class="col-sm-12 fr-row">
									<div class="form-group col-sm-12">
										<label for="css-label">Empresa</label>
										<input type="text" class="form-control" name="co_empresa" id="co_empresa" value="{{$cliente['empresa']}}" placeholder="Empresa">
									</div>
								</div>
								<div class="col-sm-12 fr-row">
									<div class="form-group col-sm-6">
										<label for="css-label">Email</label>
										<input type="text" class="form-control" name="co_email" id="co_email" value="{{$cliente['email']}}" placeholder="Email" readonly>
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
										<label for="css-label">Calle</label>
										<input type="text" class="form-control" name="co_calle_direccion" id="co_calle_direccion" value="{{$cliente['calle_direccion']}}" placeholder="Calle (*)">
									</div>
									<div class="form-group col-sm-3">
										<label for="css-label">Número</label>
										<input type="text" class="form-control" name="co_numero_direccion" id="co_numero_direccion" value="{{$cliente['numero_direccion']}}" placeholder="Número (*)">
									</div>
								</div>
								<div class="col-sm-12 fr-row">
									<div class="form-group col-sm-12">
										<label for="css-label">Referencia</label>
										<input type="text" class="form-control" name="co_referencia_direccion" id="co_referencia_direccion" value="{{$cliente['referencia_direccion']}}" placeholder="Referencia  (*)">
									</div>
								</div>
								<div class="col-sm-12 fr-row text-right">
									<button class="btn btn-primary btn-css btn-sm btn-rp" type="submit">Guardar</button>
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
		$('.select_ubigeo').select2({
			minimumResultsForSearch: 20
		});
	});
	$("input[name='co_tipo_documento']").change(function(){
		$('#co_nro_documento').val('');
		if($(this).val() == 1){
			$('#co_nro_documento').attr('maxlength', 8);
		}else{
			$('#co_nro_documento').attr('maxlength', 11);
		}
	});
	$('.update-user').each( function(){
		var form = $(this);
		form.submit(function(e) {
			$('.btn-rp').attr('disabled',true);
			if (!e.isDefaultPrevented()) {
				// var formData = new FormData(this);
				$.ajax({
					url: this.action,
					data: $(this).serialize(),
					// contentType: 'multipart/form-data',
					type: "POST",
					success: function (data) {
						if (data.success) {
							bootoast.toast({
								message: 'Cambios guardados con éxito.',
								type: 'success',
								position: 'right-top',
								icon: undefined,
								animationDuration: "300",
								dismissible: true
							});
						}					
					},error: function (data) {
						var status = data.status;
						// alert(status);
						console.log(data)
						if (data.status === 422) {
							$.each(data.responseJSON.errors, function (key, value) {
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