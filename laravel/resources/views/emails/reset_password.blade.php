<html lang="es">
<head>
	<meta charset="utf-8">
</head>
<body>
	<p>Estimado(a) {{ $name }}</p>
	<p>Por medio del presente email se informa que su contraseña se ha modificado.<br>
	La contraseña de su cuenta <b>'OMEGA'</b> se ha cancelado y se le ha otorgado una contraseña temporal.</p>
	<p>Su nueva contraseña es:<br>
		Contraseña: {{$new_password}}<br>
	</p>
	<p>Dírijase por favor a la página y cambie su contraseña temporal por una que pueda recordar mejor.</p>

	<a href="{{ url('/') }}">http://minimarket.test/</a>
	<p>Si no puede ingresar al link haciendo click, copie y pegue la dirección en la barra de direcciones de su navegador.</p>
	<br>
	<p>Saludos Cordiales.</p>
</body>
</html>