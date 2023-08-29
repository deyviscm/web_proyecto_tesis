@extends('app')

@section('content')
    <!--begin breadcrumb-wrapper-->
    <div class="breadcrumb-wrapper-contacto">

        <div class="breadcrumb-wrapper-overlay-contacto"></div>
    
        <!--begin container -->
        <div class="container">
            
            <!--begin row -->
            <div class="row">
                  
                <!--begin col-xs-6 -->
                <div class="col-xs-6">
                
                    <h2 class="page-title white">CONTACTO</h2>
                    
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
        <div class="container">

            <!--begin row-->
            <div class="row">

                <!--begin col-sm-6 -->
                <div class="col-sm-6 margin-bottom-50">
                
                    <h3>Escríbenos</h3>

                    <!--begin success message -->
                    <p class="contact_success_box" style="display:none;">Hemos recibido su información correctamente. Gracias!</p>
                    <!--end success message -->

                    <!--begin error message -->
                    <div class="errors alert alert-danger" style="display:none;"></div>
                    <!--end error message -->
                    
                    <!--begin contact form -->
                    <form id="contact-form" class="contact" action="{!! route('contacta') !!}" method="post" autocomplete="off">
                    
                        <input class="contact-input white-input" value="" name="names" placeholder="Nombre" type="text">
                        <input class="contact-input white-input" value="" name="email" placeholder="Email" type="text">
                        <input class="contact-input white-input" value="" name="phone" placeholder="Teléfono" type="text">
                        <input class="contact-input white-input" value="" name="subject" placeholder="Asunto" type="text">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <textarea class="contact-commnent white-input" rows="2" cols="20" name="message" placeholder="Mensaje"></textarea>
                        <input value="Enviar" id="submit-button" class="contact-submit" type="submit">
                        
                    </form>
                    <!--end contact form -->
                             
                </div>
                <!--end col-sm-6-->
                
                <!--begin col-sm-6 -->
                <div class="col-sm-6">

                    <h3>Ubícanos</h3>
                    
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3902.7248228070584!2d-77.07447932566048!3d-11.993532940910425!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105ce596c7ed67b%3A0xb3e5049db3340030!2sAv.%20Santiago%20Antunez%20de%20Mayolo%20898%2C%20Los%20Olivos%2015301!5e0!3m2!1ses-419!2spe!4v1684531353298!5m2!1ses-419!2spe" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                </div>
                <!--end col-sm-6-->
             
            </div>
            <!--end row-->
    
        </div>
        <!--end container-->
    
    </section>
    <!--end blog -->

@endsection