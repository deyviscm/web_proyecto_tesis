<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\User;

class ForgotPasswordController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset emails and
	| includes a trait which assists in sending these notifications from
	| your application to your users. Feel free to explore this trait.
	|
	*/

	use SendsPasswordResetEmails;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	public function showLinkRequestForm()
	{
		abort(404);
	}

	public function sendResetEmail(Request $request)
	{
		try{
			$user = User::where('email', $request->email)->first();
			if(is_null($user)){
				return response()->json(['status' => false,'message' => "El correo electrónico no esta registrado."]);
			}
			$new_password = substr(uniqid(),0,8);
			$user->password = Hash::make($new_password);
			$user->confirmed = 1;
			$user->save();
			$data = array();
			$data['name'] = $user->name;
			$data['email'] = $user->email;
			$data['new_password'] = $new_password;
			$url = url('/');
			$mensaje = "<p>Estimado(a) {$user->name}</p>";
			$mensaje .= "<p>Por medio del presente email se informa que su contraseña se ha modificado.<br>";
			$mensaje .= "La contraseña de su cuenta <b>'OMEGA'</b> se ha cancelado y se le ha otorgado una contraseña temporal.</p>";
			$mensaje .= "<p>Su nueva contraseña es:<br>";
			$mensaje .= "Contraseña: {$new_password}<br>";
			$mensaje .= "</p>";
			$mensaje .= "<p>Dírijase por favor a la página y cambie su contraseña temporal por una que pueda recordar mejor.</p>";
			$mensaje .= "<a href='{$url}'http://minimarket.test/</a>";
			$mensaje .= "<p>Si no puede ingresar al link haciendo click, copie y pegue la dirección en la barra de direcciones de su navegador.</p>";
			$mensaje .= "<br>";
			$mensaje .= "<p>Saludos Cordiales.</p>"; 

			$data['mensaje'] = $mensaje;
			$data['title'] = 'RECUPERAR CONTRASEÑA';
			
			$send = Mail::send('emails.template', $data, function($message) use ($data){
				$message->to($data['email'], $data['name'])->subject('Reset Password');
			});

			return response()->json(['status' => true,'message' => ""]);

		}catch(Exception $e){
			return response()->json(['status' => false,'message' => $e->getMessage()]);
		}
	}

}
