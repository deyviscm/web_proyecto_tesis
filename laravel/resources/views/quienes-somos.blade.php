@extends('app')
@section('style')
<style>
    .qs-img img{
        width:100%;
    }
    .r-mvv i{
        color:#25a54f;
    }
    .r-mvv h4{
        color:#000 !important;
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
                
                    <h2 class="page-title white">NOSOTROS</h2>
                    
                </div>
                <!--end col-xs-6 -->

            </div>
            <!--end row -->
            
        </div>
        <!--end container -->
        
    </div>
    <!--end breadcrumb-wrapper-->
    
    <!--begin blog -->
    <section class="section-white padding-top-30 padding-bottom-10">
        
        <!--begin container-->
        <div class="container">

            <!--begin row-->
            <div class="row">

                <div class="col-sm-6 margin-bottom-50">
                    <div class="col-sm-12">
                        <h2 class="section-title text-center" style="color:#000;">QUIENES SOMOS</h2>
                    </div>
                    <p class="text-justify">Nosotros somos una empresa nacional de capital peruano. Dedicado a la comercialización de alimentos y productos de calidad, para el hogar. Con eficacia, garantía y seguridad.</p>

                    <p class="text-justify">
                    <ul style="list-style:inside;">
                        <li><strong>CALIDAD DE PRODUCTO</strong></li>
                        <li><strong>ATENCIÓN AL CLIENTE</strong></li>
                        <li><strong>SERVICIO POST VENTA</strong></li>
                        <li><strong>ENVIOS RAPIDOS</strong></li>
                    </ul>
                    </p>       
                </div>
                <div class="col-sm-6 margin-bottom-50">
                    <div class="col-sm-12 qs-img">
                        <img src="{{ URL::asset('public/images/nosotros/quienes_somos.jpg') }}" alt="">
                    </div>
                </div>
                <!--end col-sm-6-->
             
            </div>
            <!--end row-->
    
        </div>
        <!--end container-->
    
    </section>

    <section class="section-grey padding-top-10 padding-bottom-10">
        
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <ul class="portfolio-items list-unstyled" id="grid">
                        <li class="col-md-3 col-sm-6 col-xs-12 team-item-white">
                            <figure class="portfolio-item">
                                <img src="{{ URL::asset('public/images/nosotros/img-calidad.png') }}" alt="pic">
                                <h3 style="height: 40px; overflow:hidden" class="text-center">Calidad de producto</h3>
                            </figure>
                        </li>
                        <li class="col-md-3 col-sm-6 col-xs-12 team-item-white">
                            <figure class="portfolio-item">
                                <img src="{{ URL::asset('public/images/nosotros/img-atencion-al-cliente.png') }}" alt="pic">
                                <h3 style="height: 40px; overflow:hidden" class="text-center">Atención al cliente</h3>
                            </figure>
                        </li>
                        <li class="col-md-3 col-sm-6 col-xs-12 team-item-white">
                            <figure class="portfolio-item">
                                <img src="{{ URL::asset('public/images/nosotros/img-post-venta.png') }}" alt="pic">
                                <h3 style="height: 40px; overflow:hidden" class="text-center">Servicio post venta</h3>
                            </figure>
                        </li>
                        <li class="col-md-3 col-sm-6 col-xs-12 team-item-white">
                            <figure class="portfolio-item">
                                <img src="{{ URL::asset('public/images/nosotros/img-rapido.png') }}" alt="pic">
                                <h3 style="height: 40px; overflow:hidden" class="text-center">Envíos rápidos</h3>
                            </figure>
                        </li>
                    </ul>
                    
                </div>
            </div>

        </div>    
    </section>

    <section class="section-white small-padding">
        
        <!--begin container-->
        <div class="container">
            <div class="row r-mvv">
                <div class="col-md-4">

                    <div class="service-wrapper3 text-center">

                        <i class="fa fa-cogs"></i>

                        <h4>Misión</h4>

                        <p class="text-center padding-20">Comercializar productos de consumo masivo de excelente calidad a los mejores precios del mercado, brindando la mejor opción en surtido, orientado a satisfacer las necesidades de los clientes, acompañado de un buen servicio y atención.</p>
                    </div>

                </div>
                <div class="col-md-4">

                    <div class="service-wrapper3 text-center">

                        <i class="fa fa-bullseye"></i>

                        <h4>Visión</h4>

                        <p class="text-center padding-20">Ser una de las empresas líderes a nivel nacional, ofreciendo siempre productos de excelente calidad, al mejor precio, con tiendas amplias, cómodas y modernas, que brinden seguridad y confianza a nuestros clientes que son nuestra razón de ser.</p>
                    </div>

                </div>
                <div class="col-md-4">

                    <div class="service-wrapper3 text-center">

                        <i class="fa fa-edit"></i>

                        <h4>Valores</h4>

                        <p class="text-center padding-20">Clara orientación al cliente, Compromiso, Innovación e Integridad.</p>
                    </div>

                </div>
            </div>

        </div>

    </section>

@endsection