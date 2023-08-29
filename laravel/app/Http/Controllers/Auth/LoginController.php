<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        abort(404);
    }

	public function login(Request $request)
	{
		$this->validateLogin($request);

		// If the class is using the ThrottlesLogins trait, we can automatically throttle
		// the login attempts for this application. We'll key this by the username and
		// the IP address of the client making these requests into this application.
		if (method_exists($this, 'hasTooManyLoginAttempts') &&
		    $this->hasTooManyLoginAttempts($request)) {
		    $this->fireLockoutEvent($request);

		    return $this->sendLockoutResponse($request);
		}
        $message='';
        if($this->guard()->validate($this->credentials($request))){
            // verificar si el email esta confirmado
            if(User::verifyEmailIsActive($request)){
                if ($this->attemptLogin($request)) {
                    return $this->sendLoginResponse($request);
                }
            }else{
                $message = "Pendiente de confirmar su correo electrónico, favor de revisar su buzón de correo.";
                return response()->json(['errors' => ['email' => $message]], 422);
            }
        }
		// If the login attempt was unsuccessful we will increment the number of attempts
		// to login and redirect the user back to the login form. Of course, when this
		// user surpasses their maximum number of attempts they will get locked out.
		$this->incrementLoginAttempts($request);

		return $this->sendFailedLoginResponse($request);
	}

	protected function authenticated(Request $request, $user)
	{
		return response()->json(['status' => true], 200);
	}
}
