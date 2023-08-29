@php
	$userId = 1;
	$cantidadProductos = \Cart::session($userId)->getTotalQuantity();
@endphp
<style>
	@media (min-width: 991px){
		.toggle-user {
				display: none;
		}
	}
</style>
@if(!Auth::check())
	<span class="btn-li-login" data-toggle="modal" data-target="#modal-login">
		<i class="fa fa-user fa-lg" aria-hidden="true" style="margin-right:5px;"></i> Ingresar
	</span>
@else
	<span class="btn-li-login-togle toggle-user" >
		<i class="fa fa-user fa-lg" aria-hidden="true" style="margin-right:5px;"></i> {{ Auth::user()->nombre }}
	</span>
@endif
<a href="{!! route('cart.index') !!}" style="color: #2F362F;margin-left: 10px;">
	<div class="icon-badge-container">
		<i class="fa fa-shopping-cart fa-2x"></i>
		<div class="icon-badge">{{$cantidadProductos}}</div>
	</div>
</a>