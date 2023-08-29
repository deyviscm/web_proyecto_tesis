@extends('app')
@section('style')
<style>
	.ch-panel{
		border-radius: 15px !important;
		border-color: #dfdfdf !important;
	}
	.password-update-success{
		display:none;	
	}
	.form-panel{
		color: #000;
		font-size: 12px;
		font-family: Lato,sans-serif;
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
				
					<h2 class="page-title white">CAMBIAR CONTRASEÑA</h2>
					
				</div>
				<!--end col-xs-6 -->

			</div>
			<!--end row -->
			
		</div>
		<!--end container -->
		
	</div>
	<!--end breadcrumb-wrapper-->
	
<div class="container">
	<div class="row justify-content-center" style="margin-top: 10px;">
		<div class="col-md-6">
			<div class="panel panel-default ch-panel">
				<div class="panel-heading" style="padding: 10px;"><strong class="text-dark" style="color: #000;">DATOS PERSONALES</strong></div>
				<div class="panel-body form-panel">
					<div class="password-update-error errors alert alert-danger" style="display:none;font-size: 12px;"></div>
					<div class="password-update-success alert alert-success"></div>
					<form class="password-update-form" method="POST" action="{{ route('password.change') }}">
						@csrf
						<div class="form-group">
							<label class="css-label">Password</label>
							<input id="rt-password" type="password" class="form-control" name="password" required autocomplete="new-password">
						</div>
						<div class="form-group">
							<label class="css-label">Confirmar Password</label>
							<input id="rt-password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
						</div>
						<div class="form-group row mb-0">
							<div class="col-md-6 offset-md-4">
								<button id="btn-passwod-update" type="submit" class="btn btn-primary btn-sm btn-css">
									{{ __('Reset Password') }}
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
<script>

</script>
