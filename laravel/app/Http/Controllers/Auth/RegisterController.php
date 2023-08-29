<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        abort(404);
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:clientes'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $data['confirmation_code'] = str_random(25);
        $url =  url('/register/verify/' . $data['confirmation_code']);
        $mensaje = "<h4>Hola {$data['name']}, gracias por registrarte en <strong>OMEGA</strong> !</h4>";
        $mensaje .= "<p>Por favor confirma tu correo electrónico.</p>";
        $mensaje .= "<p>Para ello simplemente debes hacer click en el siguiente enlace:</p>";
        $mensaje .= "<a href='{$url}'>Clic para confirmar tu email</a>";
        $mensaje .= "<p>Saludos Cordiales</p>";

        $data['mensaje'] = $mensaje;
        $data['title'] = 'OMEGA';

        $send = Mail::send('emails.template', $data, function($message) use ($data){
            $message->to($data['email'], $data['name'])->subject('Por favor confirma tu correo.');
        });
        $user =  User::create([
            'nombre' => $data['name'],
            'apellidos' => $data['apellido'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'confirmation_code' => $data['confirmation_code'],
        ]);
        // return response()->json(['msg' => 'Registrado'], 200);
        // send confirmation code
        return $user;
    }

    public function verify($code){
        $user = User::where('confirmation_code', $code)->first();

        if(!$user){
            return redirect('/');
        }
        $user->confirmed = true;
        $user->confirmation_code = null;
        $user->save();
        // iniciar sesión
        $this->guard()->login($user);
        return redirect('/');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        // iniciar sesión
        // $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    protected function registered(Request $request, $user)
    {
        return response()->json(['status' => True,'email' => $request->email], 200);
    }
}
