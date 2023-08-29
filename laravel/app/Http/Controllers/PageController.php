<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use \PHPMailer;
use App\Models\Productos;
use App\Models\Categorias;

class PageController extends Controller
{
    public function __construct(){
        $categorias = Categorias::all();
        $this->data['categorias'] = $categorias;
    }
    
    public function home(){
        return view('home', $this->data);
    }

    public function products($categoria_url = ''){
        $categoria = Categorias::where('url', $categoria_url)->first();
        if(!$categoria){
            return redirect('/');
        }
        
        $productos = Productos::orderBy('titulo', 'asc')->get();
        foreach ($productos as $p) {
            $p->url = str_slug($p->titulo);
            $p->save();
        }

        // $productos = Productos::where('categoria_id', $categoria->id)
        //             ->orderBy('titulo', 'asc')
        //             ->paginate(9);

        $productos = Productos::listaProductos($categoria->id);
        $this->data['title'] = $categoria->nombre;
        $this->data['categoria'] = $categoria;
        $this->data['productos'] = $productos;
        // print_r($this->data);
        // exit();
        return view('producto', $this->data);
    }

    public function productDetail($categoria_url = '', $producto_url = ''){
        $categoria = Categorias::where('url', $categoria_url)->first();
        if(!$categoria){
            return redirect('/');
        }

        // $producto = Productos::where('categoria_id', $categoria->id)
        //             ->where('url', $producto_url)
        //             ->first();
        $producto = Productos::getProducto($categoria->id, $producto_url);
        if(!$producto){
            return redirect('/');
        }
        $imagenes = Productos::getImagenes($producto->id);
        // $productos = Productos::where('url', '!=', $producto_url)
        //             ->orderByRaw('FIELD(categoria_id, "'.$categoria->id.'") DESC')
        //             ->limit(4)
        //             ->get();

        $productos = Productos::listaProductos($categoria->id, $producto_url);
        $this->data['title'] = $producto->titulo;
        $this->data['producto'] = $producto;
        $this->data['productos'] = $productos;
        $this->data['categoria'] = $categoria;
        $this->data['imagenes'] = $imagenes;
        // print_r($this->data['categorias']);
        // exit();
        return view('producto-detalle', $this->data);
    }
    
    public function contact(){
        $this->data['title'] = "Contacta con nosotros";
        return view('contacta', $this->data);
    }

    public function quienesSomos(){
        $this->data['title'] = "Quienes somos";
        return view('quienes-somos', $this->data);
    }
    
    public function sendContact(Request $request){
        $validator = \Validator::make($request->all(), [
                    'names' => 'required|min:3',
                    'email' => 'required|email',
                    'phone' => 'required|numeric',
                    'message' => 'required|min:5',
                ], [], [
                    'names' => 'nombre',
                    'email' => 'email',
                    'phone' => 'telefono',
                    'message' => 'mensaje',
                ]);

        if ($validator->fails()) {
            $errors = "";
            foreach ($validator->errors()->getMessages() as $key => $value) {
                $errors .= "<div>".$value[0]."</div>";
            }
            return response()->json(['success' => 0, 'errors' => $errors], 200);
        }
        else
        {
            $data['nombre'] = $request->names;
            $data['email'] = $request->email;
            $data['telefono'] = $request->phone;
            $data['mensaje'] = $request->message;

            $m = new PHPMailer;
            //$m->IsSMTP(); // telling the class to use SMTP
            $m->SMTPSecure = "tls";                             // Enable TLS encryption, `ssl` also accepted
            $m->Host       = env("MAIL_HOST"); // SMTP server
            $m->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                                                   // 1 = errors and messages
                                                                   // 2 = messages only
            $m->SMTPAuth   = true;                  // enable SMTP authentication
            $m->Host       = env("MAIL_HOST"); // sets the SMTP server
            $m->Port       = env('MAIL_PORT'); // set the SMTP port for the GMAIL server
            $m->Username   = env('MAIL_USERNAME'); // SMTP account username
            $m->Password   = env('MAIL_PASSWORD');        // SMTP account password
            $m->Subject    = "Formulario de contacto: ".str_limit($request->message, 25);
            $m->CharSet    = 'UTF-8';
            $m->XMailer    = ' ';
            $m->AltBody    = "Por favor utlice un navegador moderno HTML."; // optional, comment out and test
            $m->SetFrom(env('MAIL_USERNAME'), 'Minimarket Omega');
            $m->AddReplyTo(env('MAIL_USERNAME'),"Minimarket Omega");

            $m->MsgHTML(view('mail.mail', $data)->render());
            $m->send();

            return response()->json(['success' => 1], 200);
        }
    }
    
}