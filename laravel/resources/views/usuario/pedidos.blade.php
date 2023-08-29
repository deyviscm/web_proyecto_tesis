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
	.fr-row-header{
		display: flex;
		flex-direction: row;
		justify-content: space-between;
		font-size: 15px;
		font-weight: 600;
		margin: 10px 0px;
		border-bottom: 1px solid rgb(224, 224, 224);
    	padding: 10px 0px;
	}
	.css-compra{
		display: flex;
		flex-direction: column;
	}
	.css-compra span{
		padding: 5px 0px;
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
				
					<h2 class="page-title white">MIS COMPRAS</h2>
					
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
								<div class="col-md-12 fr-row-filter">
									<div class="form-group col-md-3">
										<div class="input-group">
											<input type="hidden"  id="page" name="page" value="{{$page}}">
											<input type="hidden"  id="items" name="items" value="{{$items}}">
											<input type="text" class="form-control" id="search" name="search" placeholder="Buscar por Nº de pedido">
											<div class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></div>
										</div>
									</div>
									<div class="form-group col-md-3 col-md-offset-6">
										<select class="form-control select_date" name="date" id="date">
											@php
												for($init = 2023; $init<= date('Y');$init++){
											@endphp
											<option value = '{{$init}}'>{{$init}}</option>
											@php		
												}
											@endphp
										</select>
									</div>
								</div>

							</div>
						</div>
					</div>
					<div class="listado-compras">
					</div>
					<!-- <div class="col-md-12 margin-bottom-5">
						<div class="panel panel-default cart-form-list">
							<div class="panel-body form-cart padding-top-10">
								<div class="col-md-12">
									<div class="fr-row-header">
										<span>Compra Online</span>
										<span>Fecha Compra: 12/12/2022</span>
									</div>
								</div>
								<div class="col-md-12">
									<div class="col-md-9">
										<div class="css-compra">
											<span>Compras: Nº 5339190743</span>
											<span>Estado: En Progreso</span>
											<span>Cantidad Productos: 10</span>
											<span>Total: S/ 10.00</span>
										</div>
									</div>
									<div class="col-md-3">
										<a href="{!! route('cuenta.ordersCompras.detail', [10]) !!}" class="btn btn-lg btn-block btn-primary btn-css btn-sm">Ver Detalle</a>
									</div>
								</div>

							</div>
						</div>	
					</div> -->

					<div class="col-md-12 text-center">
						<button class="btn btn-primary btn-css btn-sm btn-submit" type="submit">VER MÁS COMPRAS</button>
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
	var process = $("#overlay");
	var pages_total = 0;
	var filtros = {
		search : '',
		date : '',
	};
	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip()
		$('.select_date').select2({
			minimumResultsForSearch: 20
		});
	});

	// $(".btn-submit" ).trigger( "click" );
	$('.pedidos-user').each( function(){
		var form = $(this);
		form.submit(function(e) {
			// window.location = url;
			process.show();
			var page = $('input[name="page"]').val();
			if (!e.isDefaultPrevented()) {
				searchCompras();
				e.preventDefault();
			}
		});
	});

	function searchCompras(){
		// validar filtros
		if(filtros.search != $('input[name="search"').val() || filtros.date != $('input[name="date"').val()){
			pages_total = 0;
			page = 1;
			$('input[name="page"]').val(page);
			$('.listado-compras').html('');
		}
		// validar busqueda - total de paginas
		if(pages_total != 0 && parseInt(page) > pages_total){
			bootoast.toast({
				message: 'Se listaron todas las Compras realizadas.',
				type: 'success',
				position: 'right-top',
				icon: undefined,
				animationDuration: "300",
				dismissible: true
			});
			process.hide();
			return false;
		}
		
		// params = {}				
		// path = 'date=2022&search='
		// window.history.replaceState(params, 'Pedidos', '/cuenta/ordersCompras?'+path);

		$.ajax({
			url: url_site+'/cuenta/ordersCompras',
			data: $('.pedidos-user').serialize(),
			// contentType: 'multipart/form-data',
			type: "POST",
			success: function (data) {
				if (data.success) {
					if(data.data.length > 0){
						$.each(data.data, function (key, value) {
							var html_orders = '<div class="col-md-12 margin-bottom-5">'
							html_orders +=		'<div class="panel panel-default cart-form-list">'
							html_orders +=			'<div class="panel-body form-cart padding-top-10">'
							html_orders +=				'<div class="col-md-12">'
							html_orders +=					'<div class="fr-row-header">'
							html_orders +=						'<span>Compra Online</span>'
							html_orders +=						'<span>Fecha Compra: '+value.fecha_compra+'</span>'
							html_orders +=					'</div>'
							html_orders +=				'</div>'
							html_orders +=				'<div class="col-md-12">'
							html_orders +=					'<div class="col-md-9">'
							html_orders +=						'<div class="css-compra">'
							html_orders +=							'<span>Compras: Nº '+value.nro_orden+'</span>'
							html_orders +=							'<span>Estado: '+value.desc_estado+'</span>'
							html_orders +=							'<span>Cantidad Productos: '+value.total_productos+'</span>'
							html_orders +=							'<span>Total: '+value.simbolo+' '+value.total.toFixed(2)+'</span>'
							html_orders +=						'</div>'
							html_orders +=					'</div>'
							html_orders +=					'<div class="col-md-3">'
							html_orders +=						'<a href="'+url_site+'/cuenta/ordersCompras/detail/'+value.id+'" class="btn btn-lg btn-block btn-primary btn-css btn-sm">Ver Detalle</a>'
							html_orders +=					'</div>'
							html_orders +=				'</div>'
							html_orders +=			'</div>'
							html_orders +=		'</div>'
							html_orders +=	'</div>';
							$('.listado-compras').append(html_orders);
						});
						filtros.search = $('input[name="search"').val();
						filtros.date = $('input[name="date"').val();
						// total de paginas
						pages_total = parseInt(data.pages);
						if(pages_total >= page){
							page = parseInt(page) + 1;
							$('input[name="page"]').val(page);
						}
					}else{
						// iniciar total de paginas
						pages_total = 0;
						// limpiar listado
						$('.listado-compras').html('');
						// reset pagina
						$('input[name="page"]').val(1);

						filtros.search = '';
						filtros.date = '';
					}
				}					
			},error: function (data) {
				
			},complete: function(data){
				process.hide();
			}
		});
	}
	// cargar compras
	searchCompras()
</script>
@endsection