<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset requests
	| and uses a simple trait to include this behavior. You're free to
	| explore this trait and override any methods you wish to tweak.
	|
	*/

	use ResetsPasswords;

	/**
	 * Where to redirect users after resetting their password.
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
        // $this->middleware('auth');
	}

	// public function showLinkRequestForm()
	// {
	//     return view('auth.passwords.email');
	// }
	public function showNewPassword()
    {
		// abort(404);
        return view('auth.passwords.reset');
    }

	// public function showResetForm(Request $request, $token = null)
    // {
	// 	// abort(404);
    //     return view('auth.passwords.reset')->with(
    //         ['token' => $token, 'email' => $request->email]
    //     );
    // }

	public function updatePassword(Request $request){
		try{
			Validator::make($request->all(),[
				'password' => ['required', 'string', 'min:4', 'confirmed']
			])->validate();
			
			$user = Auth::user();
			$user->password = Hash::make($request->password);
			$user->save();
			return response()->json(['status' => true, 'message' => '']);
		}catch(Exception $e){
			return response()->json(['status' => false, 'message' => $e->getMessage()]);
		}
		
	}

	public function sendResetLinkEmail(Request $request)
	{
		$this->validateEmail($request);

		// We will send the password reset link to this user. Once we have attempted
		// to send the link, we will examine the response then see the message we
		// need to show to the user. Finally, we'll send out a proper response.
		$response = $this->broker()->sendResetLink(
			$this->credentials($request)
		);

		return $response == Password::RESET_LINK_SENT
					? $this->sendResetLinkResponse($request, $response)
					: $this->sendResetLinkFailedResponse($request, $response);
	}
}
