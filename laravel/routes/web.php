<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('register/verify/{code}','Auth\RegisterController@verify');
Route::post('password/sendemail', 'Auth\ForgotPasswordController@sendResetEmail')->name('password-sendemail');
// Route::get('logindemo', 'Auth\LoginController@showLoginForm');

Route::get('/', 'PageController@home')->name('home');

Route::get('contacta-con-nosotros', 'PageController@contact')->name('contacta-con-nosotros');

Route::post('contacta', 'PageController@sendContact')->name('contacta');

Route::get('quienes-somos', 'PageController@quienesSomos')->name('quienes-somos');

Route::get('productos/{category}', 'PageController@products')->name('productos');

Route::get('productos/{category}/{id}', 'PageController@productDetail')->name('producto-detalle');

// CART
Route::get('/cart','CartController@index')->name('cart.index');
Route::post('cart/add', 'CartController@addItem');
Route::post('cart/update', 'CartController@updateItem');
Route::post('cart/delete', 'CartController@removeItem');
Route::post('cart/orders', 'CartController@orders');

Route::get('checkout/orders','CheckoutOrdersController@index')->name('checkout.index');
Route::post('checkout/registrar','CheckoutOrdersController@registrar')->name('checkout.save');
Route::get('checkout/completed/{idOp}', 'CheckoutOrdersController@completed')->name('checkout.completed');

Route::get('productos', function() {
    return redirect('/');
});

Route::any('web', function() {
    return redirect('/');
});
Route::group(['middleware' => 'auth'], function(){
    
    Route::get('cuenta/userpersonal','UsuarioController@userpersonal')->name('cuenta.userpersonal');
    Route::post('cuenta/userpersonal','UsuarioController@updateUser')->name('cuenta.userpersonal');

    Route::get('cuenta/ordersCompras','UsuarioController@usercompras')->name('cuenta.orders');
    Route::post('cuenta/ordersCompras','UsuarioController@ordersCompras');
    Route::get('cuenta/ordersCompras/detail/{id}','UsuarioController@ordersComprasDetail')->name('cuenta.ordersCompras.detail');



    Route::get('password/nuevo-password', 'Auth\ResetPasswordController@showNewPassword')->name('password.new');
    Route::post('password/change', 'Auth\ResetPasswordController@updatePassword')->name('password.change');

});
Auth::routes();
Auth::routes(['register' => false, 'reset' => false]);
// Route::get('/prueba', 'HomeController@index')->name('home');
