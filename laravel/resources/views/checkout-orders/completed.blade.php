@extends('app')
@section('style')
<style>
	
	.css-check{
		text-align: center;
		font-size: 12em;
		color: #63a50c;
	}
	.css-btn-volver{
		text-align:center;
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
				
					<h2 class="page-title white">COMPRA REGISTRADA</h2>
					
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
				
				<div class="css-check">
					<span><i class="fa fa-check-circle-o" aria-hidden="true"></i></span>
				</div>
				<div class="col-md-7 col-md-offset-3 margin-bottom-50">
					<div class="css-cart">
						<div class="css-title">
							<h2>Gracias por preferir <b>Omega<b></h2>
							<h2>Recibimos tu orden de compra!</h2>
						</div>
						<div class="css-body">
							<p>Hola {{$ordenPedido->nombre}},</p>
							<p>Recibimos la solicitud de compra que realizaste en nuestro sitio; tu número de orden es <b>N° {{$ordenPedido->nro_orden}}</b>.</p>
						</div>
					</div>
				</div>
				<div class="text-center">
					@if(isset($categorias))
						<a href="{!! route('productos', [$categorias[0]->url]) !!}" class="btn btn-sm btn-primary btn-css">VOLVER A LA TIENDA</a>
					@endif
				</div>
			 
			</div>
			<!--end row-->
	
		</div>
		<!--end container-->
	
	</section>
	<!--end blog -->

@endsection
@section("scripts")
<script>

</script>
@endsection