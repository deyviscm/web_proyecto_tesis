@extends('app')

@section('style')
<style>
	.h-str{
		display: flex;
		flex-direction: row;
		justify-content: center;
		border-style: solid;
		border-width: 1px 1px 1px 1px;
		border-color: #C5C5C5;
		border-radius: 5px 5px 5px 5px;
		padding: 5px;
	}
	.h-str i{
		color: #24A52F;
		margin: 5px;
	}
	.h-ct{
		margin: 5px;
	}
	.h-ct h3{
		font-size: 16px;
		font-weight: 500;
		text-transform: uppercase;
		margin: 5px 0px;
		color: #000;
	}
	.hm-promo img{
		width:100%;
	}
</style>
@endsection
@section('content')

    <div style="position: relative;overflow: hidden;">
        <div class="camera_wrap camera_azure_skin" id="camera_wrap_1">
            <div data-src="{{ URL::asset('public/images/banner/header_2.png') }}"></div>
            <div data-src="{{ URL::asset('public/images/banner/header_1.png') }}"></div>
            <div data-src="{{ URL::asset('public/images/banner/header_3.png') }}"></div>
            <div data-src="{{ URL::asset('public/images/banner/header_4.png') }}"></div>
        </div>
    </div>


    <!--begin section-white -->
    <section class="section-white padding-top-10 padding-bottom-10">
        
        <!--begin container-->
        <div class="container">

            <!--begin row-->
            <div class="row">

                    <!--begin col-md-12-->
                    <div class="col-md-12">


                        <!--begin portfolio-items-->
                        <ul class="portfolio-items list-unstyled" id="grid">
                  
                            @foreach($categorias as $p)
                            
                            <!--begin team-item -->
                            <li class="col-md-3 col-sm-6 col-xs-12 team-item-white">

                                <a href="{{ route('productos', [$p->url]) }}">

                                    <figure class="portfolio-item">

                                        <img src="{{ URL::asset('public/images/categorias/'.$p->imagen) }}" class="img-responsive" alt="pic">

                                        <h3 style="height: 40px; overflow:hidden" class="text-center">{{ $p->nombre }}</h3>

                                    </figure>

                                </a>
                                
                            </li>
                            <!--end team-item -->
                            
                            @endforeach

                        </ul>
                        <!--end portfolio-items-->
                        
                    </div>
                    <!--end col-md-12-->

            </div>
            <!--end row-->

        </div>
        <!--end container-->
    
    </section>
    <!--end section-white-->

    <!--begin section-grey -->
    <section class="section-grey padding-top-10 padding-bottom-10">
        
        <!--begin container-->
        <div class="container">

            <!--begin row-->
            <div class="row margin-bottom-10">
                <div class="col-md-12">
                    <h2 class="section-title dark-blue text-center">PROMOCIONES</h2>
                </div>
            </div>
            <div class="row hm-promo text-center">
                <div class="col-md-4 col-sm-6 col-xs-12 margin-bottom-10">
					<img src="{{ URL::asset('public/images/home/gloria.png') }}" alt="" width="100">
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12 margin-bottom-10">
					<img src="{{ URL::asset('public/images/home/golden.png') }}" alt="">
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12 margin-bottom-10">
					<img src="{{ URL::asset('public/images/home/nova.png') }}" alt="">
				</div>
			</div>

        </div>
        <!--end container-->
    
    </section>
    <!--end section-white-->

    <!--begin section-white -->
    <section class="section-white padding-top-50 padding-bottom-50">
        
        <div class="container">

            <div class="row">
				<div class="col-md-3" style="margin-bottom: 10px;">							
					<div class="h-str">
						<div class="h-icon">
							<i class="fa fa-truck fa-flip-horizontal fa-4x" aria-hidden="true"></i>
						</div>
						<div class="h-ct">
							<h3>ENVIÓ A DOMICILIO</h3>
							<span>Recíbelo en la comodidad de tu casa</span>
						</div>

					</div>
				</div>
				<div class="col-md-3" style="margin-bottom: 10px;">							
					<div class="h-str">
						<div class="h-icon">
							<i class="fa fa-credit-card fa-4x" aria-hidden="true"></i>
						</div>
						<div class="h-ct">
							<h3>MEDIOS DE PAGO</h3>
							<span>Múltiples medios de pago seguro</span>
						</div>

					</div>
				</div>
				<div class="col-md-3" style="margin-bottom: 10px;">							
					<div class="h-str">
						<div class="h-icon">
							<i class="fa fa-lightbulb-o fa-4x" aria-hidden="true"></i>
						</div>
						<div class="h-ct">
							<h3>GARANTÍA TOTAL</h3>
							<span>Conoce nuestra política de precios bajos</span>
						</div>

					</div>
				</div>
				<div class="col-md-3" style="margin-bottom: 10px;">							
					<div class="h-str">
						<div class="h-icon">
							<i class="fa fa-home fa-4x" aria-hidden="true"></i>
						</div>
						<div class="h-ct">
							<h3>RETIRO EN TIENDA</h3>
							<span>Compra y ahórrate el costo del envío</span>
						</div>

					</div>
				</div>
            </div>

        </div>
    
    </section>
    <!--end section-white-->

@endsection

@section('scripts')
<script>
    jQuery(function(){
        jQuery('#camera_wrap_1').camera({
            thumbnails: false,
            fx: 'simpleFade',
            pagination: false,
            loader: 'none',
            time: 2500,
            hover: false,
            playPause: false,
            // height: ($('.hero-box').outerHeight()+40)+"px",
            height: "500px",
            onStartLoading: function() { }
        });

    });
</script>
@endsection