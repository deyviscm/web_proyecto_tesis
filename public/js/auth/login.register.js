$(window).on('load', function(){
	$('.login-form').each( function(){
		var form = $(this);
		$('#login-error').hide();
		form.submit(function(e) {
			form.parent().find('.errors').html('').hide();
			if (!e.isDefaultPrevented()) {
				$.ajax({
					url: this.action,
					data: $(this).serialize(),
					type: "POST",
					success: function (data) {
						if (data.status) {
							location.reload();
						}	
					},error: function (data) {
						var status = data.status;
						// alert(status);
						if (data.status === 422) {
							$('#login-error').show();
							$.each(data.responseJSON.errors, function (key, value) {
								$('#login-error').append('<div>' + value + '</div>');
							});
						}
					}
				});
				e.preventDefault();
			}
		});
	});

	$('.register-form').each( function(){
		var form = $(this);
		$('.register-error').hide();
		form.submit(function(e) {
			form.parent().find('.errors').html('').hide();
			$('#btn-registrar').attr('disabled',true);
			
			if (!e.isDefaultPrevented()) {
				$.ajax({
					url: this.action,
					data: $(this).serialize(),
					type: "POST",
					success: function (data) {
						if (data.status) {
							// location.reload();
							$('.message-email').html(data.email);
							$('.message-register').show();
							$('.register-form').hide();
						}					
					},error: function (data) {
						var status = data.status;
						// alert(status);
						if (data.status === 422) {
							$('.register-error').show();
							$.each(data.responseJSON.errors, function (key, value) {
								$('.register-error').append('<div>' + value + '</div>');
							});
						}
					},complete: function(data){
						$('#btn-registrar').attr('disabled',false);
					}
				});
				e.preventDefault();
			}
		});
	});

	$('.reset-password-form').each( function(){
		var form = $(this);
		form.submit(function(e) {
			form.parent().find('.errors').html('').hide();
			$('#btn-reset-password').attr('disabled',true);
			$('.reset-password-success').hide();

			if (!e.isDefaultPrevented()) {
				$.ajax({
					url: this.action,
					data: $(this).serialize(),
					type: "POST",
					success: function (data) {
						if (data.status) {
							// location.reload();
							$('#rt-email').val('');
							$('.reset-password-success').show();
						}else{
							$('.reset-password-error').show();
							$('.reset-password-error').append(data.message);
						}
					},error: function (data) {
						var status = data.status;
						// alert(status);
						if (data.status === 422) {
							$('.reset-password-error').show();
							$.each(data.responseJSON.errors, function (key, value) {
								$('.reset-password-error').append('<div>' + value + '</div>');
							});
						}
					},complete: function(data){
						$('#btn-reset-password').attr('disabled',false);
					}
				});
				e.preventDefault();
			}
		});
	});

	$('.password-update-form').each( function(){
		var form = $(this);
		form.submit(function(e) {
			form.parent().find('.password-update-error').html('').hide();
			$('#btn-passwod-update').attr('disabled',true);
			$('.password-update-success').hide();

			if (!e.isDefaultPrevented()) {
				$.ajax({
					url: this.action,
					data: $(this).serialize(),
					type: "POST",
					success: function (data) {
						if (data.status) {
							$('#rt-password').val('');
							$('#rt-password-confirm').val('');
							$('.password-update-success').html("Se actualizo correctamente.");
							$('.password-update-success').show();
						}else{
							$('.password-update-error').show();
							$('.password-update-error').append(data.message);
						}
					},error: function (data) {
						var status = data.status;
						if (data.status === 422) {
							$('.password-update-error').show();
							$.each(data.responseJSON.errors, function (key, value) {
								$('.password-update-error').append('<div>' + value + '</div>');
							});
						}
					},complete: function(data){
						$('#btn-passwod-update').attr('disabled',false);
					}
				});
				e.preventDefault();
			}
		});
	});

	$('#modal-login').on('hidden.bs.modal', function () {
		cerrarModalLogin();
	});

});
function cerrarModalLogin(){
	$('.register-form').show();
	$('.message-register').hide();
	$('.ct-register').hide();
	$('.ct-login').show(100);
}
function openForm(view){
	if(view == 'register'){
		$('.register-error').hide();
		$('.ct-register').show(100);
		$('.ct-login').hide(100);
		$('.register-form')[0].reset();
	}else if(view == 'reset'){
		$('.reset-password-error').hide();
		$('.ct-reset-password').show(100);
		$('.ct-login').hide(100);
		$('.reset-password-form')[0].reset();
	}
}

function updatePage(view){
	// form login
	$('#lg-email').val('');
	$('#lg-password').val('');
	$('#login-error').html('');
	$('#login-error').hide();
	// mostrar form login
	$('.ct-login').show(100);
	// ocultar form 
	
	$('.register-error').html('');
	$('.register-error').hide();
	$('.ct-register').hide(100); // registrar
	
	$('.reset-password-error').html('');
	$('.reset-password-error').hide();
	$('.ct-reset-password').hide(100); // reset password
	$('.reset-password-success').hide();

}