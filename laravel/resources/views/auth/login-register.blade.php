<style>
    @media(max-width: 991px) {
        .navbar-login-menu {
            display: none;
        }
    }
    .close{
        font-size: 30px;
    }

    .modal-content{
        /* height: 580px; */
		min-width: 400px;
    }    
    .a-register{
        color: #003059;
        font-weight: bold;
        cursor: pointer;
        font-style: initial;
        font-family: Roboto,sans-serif;
    }
    .a-password{
        color: #121211;
        font-weight: bold;
        cursor: pointer;
        font-style: initial;
        font-family: Roboto,sans-serif;
    }
	.ct-login{
		/* position: absolute; */
	}

	.ct-login .header-login{
        position: relative;
        text-align: center;
    }
	.ct-login .modal-body .s-btn-registrar{
		position: relative;
		/* bottom: -120px; */
		display: flex;
		justify-content: center;
	}
	.ct-register{
		position: absolute;
	}
	.ct-register .header-register{
        display: flex;
		justify-content: space-between;
    }
	.ct-register .header-register .fa-arrow-left{
		line-height: 1.8;
		cursor:pointer;
	}
	.ct-register .message-register{
		display:none;
	}
	.ct-register .message-register .message-header{
		text-align: center;
    	line-height: 100px;
	}
	.ct-register .message-register .message-email{
		font-weight: 700;
		font-family: Roboto,sans-serif;
		display: block;
		text-align: center;
		margin: 10px;
		line-height: 100px;
	}
	.ct-register .message-register .message-body{
		margin: 10px;
		padding: 5px;
		display: block;
	}
	.ct-reset-password{
		position: absolute;
	}
	.ct-reset-password .header-reset-password{
        display: flex;
		justify-content: space-between;
    }
	.ct-reset-password .header-reset-password .fa-arrow-left{
		line-height: 1.8;
		cursor:pointer;
	}
	.ct-reset-password .reset-password-success{
		font-size: 12px;
		display: none;
	}
	.btn-css{
		background: #24A52F;
	}
</style>
	<div class="modal fade" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="modal-loginLabel" data-keyboard="false" data-backdrop="static">
		<div class="modal-dialog modal-sm" role="document" style="background:white;">
			<!-- 
			###########################################################################
			#### LOGIN
			###########################################################################
			-->
			<div class="modal-content ct-login">
				<div class="modal-header" style="padding: 5px 15px;">
                    <div class="header-login">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modal-loginLabel">Iniciar Sesión</h4>
                    </div>
				</div>
				<div class="modal-body">
					<!--begin error message -->
					<div id="login-error" class="errors alert alert-danger" style="display:none;font-size: 12px;"></div>
					<form class="login-form" method="POST" action="{{ route('login') }}">
						@csrf
						<!-- <fieldset> -->
							<div class="input-group" style="margin-bottom:10px;">
								<div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
								<input class="form-control" id="lg-email" placeholder="E-mail" name="email" type="text">
							</div>
							<div class="input-group" style="margin-bottom:10px;">
								<div class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></div>
								<input class="form-control" id="lg-password" placeholder="Password" name="password" type="password" value="">
							</div>
							<div class="checkbox">
								<span>
									<!-- <input name="remember" type="checkbox" value="Remember Me"> Remember Me -->
									<a class="a-password" onclick="openForm('reset')">¿Olvidaste tu contraseña?</a>
								</span>
							</div>
							<div class="text-right">
								<input class="btn btn-primary btn-sm btn-lg btn-block btn-css" type="submit" value="Login">
							</div>
						<!-- </fieldset> -->
				  	</form>
					<div class="s-btn-registrar">
						<a class="a-register" onclick="openForm('register')">
							¿Eres nuevo? <u>Registrate</u>
						</a>
					</div>
				</div>
			</div>

			<!-- 
			###########################################################################
			#### REGISTRAR
			###########################################################################
			-->
            <div class="modal-content ct-register" style="display:none;">
				<div class="modal-header" style="padding: 5px 15px;">
                    <div class="header-register">
						<i class="fa fa-arrow-left fa-lg" aria-hidden="true" onclick="updatePage('register')"></i>
                        <h4 class="modal-title" id="modal-loginLabel">Regístrate</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
				</div>
				<div class="modal-body">
					<!--begin error message -->
					<div class="register-error errors alert alert-danger" style="display:none;font-size: 12px;"></div>
					<div class="message-register">
						<h4 class="message-header"style="text-align: center;">¡Listo! Revisa tu correo</h4>
						<span class="message-body">Esta acción require una verificación de correo. Por favor revisa tu buzón de correo y sigue las instrucciones enviadas.
						El correo fue enviado a :</span>
						<span class="message-email">demo@demo.com</span>
						<div class="text-right">
							<input class="btn btn-danger btn-sm btn-lg btn-block" value="Cerrar" onclick="cerrarModalLogin()">
						</div>
					</div>
					<form class="register-form" method="POST" action="{{ route('register') }}">
						@csrf
						<!-- <fieldset> -->
						<div class="form-group">
							<label for="lblName">Nombre</label>
							<input id="name" type="text" class="form-control" name="name" required autocomplete="name" autofocus>
						</div>
						<div class="form-group">
							<label for="lblName">Apellidos</label>
							<input id="apellido" type="text" class="form-control" name="apellido" required autocomplete="apellido" autofocus>
						</div>
						<div class="form-group">
							<label for="lblEmail">Email address</label>
							<input id="email" type="email" class="form-control" name="email" required autocomplete="email">
						</div>
						<div class="form-group">
							<label for="lblPassword">Password</label>
							<input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
						</div>
						<div class="form-group">
							<label for="lblPassword">Confirmar Password</label>
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
						</div>
						<div class="text-right">
							<input id="btn-registrar" class="btn btn-primary btn-sm btn-lg btn-block btn-css" type="submit" value="Registrar">
						</div>
				  	</form>
				</div>
			</div>

			<!-- 
			###########################################################################
			#### RECUPERAR CONTRASEÑA
			###########################################################################
			-->
			<div class="modal-content ct-reset-password" style="display:none;">
				<div class="modal-header" style="padding: 5px 15px;">
                    <div class="header-reset-password">
						<i class="fa fa-arrow-left fa-lg" aria-hidden="true" onclick="updatePage('register')"></i>
                        <h4 class="modal-title" id="modal-loginLabel">Restablecer la contraseña</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
				</div>
				<div class="modal-body">
					<!--begin error message -->
					<div class="reset-password-error errors alert alert-danger" style="display:none;font-size: 12px;"></div>
					<div class="reset-password-success alert alert-success" style="">Se envió un correo electrónico, favor de revisar su buzón.</div>
					<form class="reset-password-form" method="POST" action="{{ route('password-sendemail') }}">
						@csrf
						<!-- <fieldset> -->
							<div class="input-group" style="margin-bottom:10px;">
								<div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
								<input class="form-control" id="rt-email" placeholder="E-mail" name="email" type="email" required autocomplete="email">
							</div>
							<div class="text-right">
								<input id="btn-reset-password" class="btn btn-primary btn-sm btn-lg btn-block btn-css" type="submit" value="Enviar enlace">
							</div>
						<!-- </fieldset> -->
				  	</form>
				</div>
			</div>

		</div>
	</div>
<script>
	
</script>