<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\CtaBancaria;
use App\Models\CheckoutOrders;
use App\Models\Categorias;
use Darryldecode\Cart\CartCondition;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\User;

class CheckoutOrdersController extends Controller
{

	public function __construct(){
		$categorias = Categorias::all();
        $this->data['categorias'] = $categorias;
	}
	
	public function index()
	{
		$data = [];

		// Datos de Cliente
		$user = Auth::user();
		// $user = User::where('email', $request->email)->first();
		# Unbigeo
		$ubigeo = CheckoutOrders::getUbigeo();
		$cta_bancaria = CtaBancaria::where('estado', 1)->first();
		
		# lista productos
		$data['cliente'] = $user;
		$data['ubigeo'] = $ubigeo;
		$data['cta_bancaria'] = $cta_bancaria;
		$data['disabled'] = 'readonly';
		$data['tipo_user'] = 'CLIENTE';
		if(is_null($user)){
			$data['disabled'] = '';
			$data['tipo_user'] = 'INVITADO';
		}
		$datos_pd = $this->getProductos();
		$arr_datos = array_merge($data, $datos_pd);
		return view('checkout-orders.index', $arr_datos);
	}

	public function getProductos(){
		$data = [];
		$productos = [];
		$userId = 1; // get this from session or wherever it came from
		\Cart::session($userId)->getContent()->each(function($item) use (&$productos)
		{
			$productos[] = $item;
		});
		$arr_productos = collect($productos);
		# Id de los productos
		$idProductos = $arr_productos->pluck('id')->all();
		#agrupar por id producto
		$prod_id = $arr_productos->groupBy('id')->all();
		# datos de los productos seleccionados
		$listaProductos = Productos::listaComprasProductos($idProductos);
		foreach($listaProductos as $row){
			$row->quantity = $prod_id[$row->id][0]->quantity;
		}

		// Agregar importe de Envío
		// $condition1 = new \Darryldecode\Cart\CartCondition(array(
		// 	'name' => 'Envío a domicilio 15',
		// 	'type' => 'shipping',
		// 	'target' => 'total',
		// 	'value' => '+15',
		// 	'order' => 1
		// ));

		// \Cart::condition($condition1);

		$totales = array(
			'envio_domicilio' => \Cart::getCondition('envio-domicilio'),
			'total_quantity' => \Cart::session($userId)->getTotalQuantity(),
			'sub_total' => \Cart::session($userId)->getSubTotal(),
			'total' => \Cart::session($userId)->getTotal(),
		);

		$data['productos'] = $listaProductos;
		$data['totales'] = $totales;
		return $data;
	}

	public function registrar(Request $request){

		$validator = Validator::make($request->all(), [
			'co_nombre' => 'required',
			'co_apellidos' => 'required',
			'co_email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i',
			'co_img_transferencia' =>  $request->co_tipo_pago == '1' ? 'required|mimes:jpeg,jpg,png,gif|max:3048' : 'nullable',
			'co_celular' => 'required|numeric|digits:9',
			'co_ubigeo' => 'required',
			'co_calle_direccion' => 'required',
			'co_numero_direccion' => 'required',
			'co_referencia_direccion' => 'required',
			'co_nro_documento' => $request->co_tipo_comprobante == '1' ? 'required|numeric|digits:8' : 'required|numeric|digits:11',
			'terminos_condiciones' => 'required',
		],[],[
			'co_nombre' => 'Nombre',
			'co_apellidos' => 'Apellidos',
			'co_email' => 'Email',
			'co_img_transferencia' => 'Imagen',
			'co_celular' => 'Celular',
			'co_ubigeo' => 'Dirección',
			'co_calle_direccion' => 'Calle',
			'co_numero_direccion' => 'Número',
			'co_referencia_direccion' => 'Referencia',
			'co_nro_documento' => 'Nro Documento',
			'terminos_condiciones' => 'términos y condiciones.',
		]
		);
			
		// $validator->setAttributeNames($niceNames); 
		$validator->validate();
		// validar imagen
		$filename = '';
		$imageName = '';
		if($request->co_tipo_pago == '1'){
			$file = $request->file('co_img_transferencia');
			$nameOrigin = $file->getClientOriginalName();
			$extension = $file->getClientOriginalExtension();
			$filename = pathinfo($nameOrigin , PATHINFO_FILENAME);
			$imageName = $filename.'_'.time().'.'.$extension;
         
			$request->co_img_transferencia->move(public_path('imagen_transferencia'), $imageName);
		}
		$fechaIn = date('Y-m-d H:i:s');
		try{
			// $item = \Cart::session($this->userCart)->add($idProducto, $producto->titulo, $producto->precio_unitario, $cantidad, $customAttributes);
			DB::beginTransaction();

			$datos = [];
			$datos['nombre'] = $request->co_nombre;
			$datos['apellidos' ] = $request->co_apellidos;
			$datos['empresa' ] = $request->co_empresa;
			$datos['celular' ] = $request->co_celular;
			$datos['ubigeo' ] = $request->co_ubigeo;
			$datos['calle_direccion'] = $request->co_calle_direccion;
			$datos['numero_direccion' ] = $request->co_numero_direccion;
			$datos['referencia_direccion' ] = $request->co_referencia_direccion;

			// datos de usuario logueado
			$user = Auth::user();

			if(is_null($user)){
				// Id = null => Invitado
				$user_id = null;
			}else{
				$user_id = $user->id;
				// actualizar datos usuario
				$user = User::updateData($user_id, $datos);
			}

			$datos['email' ] = $request->co_email;
			$datos['tipo_comprobante' ] = $request->co_tipo_comprobante;
			$datos['nro_documento' ] = $request->co_nro_documento;

			$datos['tipo_pago'] = $request->co_tipo_pago;
			$datos['id_cuenta_bancaria' ] = $request->co_cta_id;

			$datos['imagen_tranferencia' ] = $imageName;

			$datos['id_moneda' ] = 1; // SOLES 

			// Datos de Productos
			$datos_pd = $this->getProductos();

			$datos['subtotal' ] = round($datos_pd['totales']['sub_total'], 2);
			$datos['envio_pedido' ] = (float) $datos_pd['totales']['envio_domicilio']->getValue(); //  costo de envío de pedido - temporal
			$datos['total' ] = round($datos_pd['totales']['total'], 2);

			$datos['estado_pedido' ] = 1; // Recibido
			$datos['terminos_condiciones'] = (isset($request->terminos_condiciones) && $request->terminos_condiciones) ? 1 : 0; 
			$datos['tratamiento_datos'] = (isset($request->tratamiento_datos) && $request->tratamiento_datos) ? 1 : 0;
			$datos['fechaIn' ] = $fechaIn;

			$datos['idcliente' ] = $user_id;
			$resp_op = CheckoutOrders::registrar($datos);
			$id_op = $resp_op['id'];
			// guardar transferencia
			if($imageName != ''){
				$sourceFilePath = public_path()."/imagen_transferencia/{$imageName}";
				$destinationPath = "public/images/imagen_transferencia/{$id_op}";
				if(!\File::isDirectory($destinationPath)){
					\File::makeDirectory($destinationPath, 0777, true, true);
				}
				$success = \File::copy($sourceFilePath,$destinationPath.'/'.$imageName);
			}
			
			$arr_dp = [];
			$detalle = [];
			if(count($datos_pd['productos']) > 0){
				foreach($datos_pd['productos'] as $row){
					$arr_dp['id_op'] = $id_op;
					$arr_dp['id_moneda'] = $row->id_moneda;
					$arr_dp['id_producto'] = $row->id;
					$arr_dp['producto'] = $row->titulo;
					$arr_dp['precio_unitario'] = $row->precio_unitario;
					$arr_dp['cantidad'] = $row->quantity;
					$arr_dp['subtotal'] = round(($row->precio_unitario * $row->quantity), 2);
					$arr_dp['total'] = round(($row->precio_unitario * $row->quantity), 2);
					$arr_dp['idcliente'] = $user_id;
					$arr_dp['fechaIn' ] = $fechaIn;
					$id_dp = CheckoutOrders::registrarDetalle($arr_dp);
					$detalle[] = $arr_dp;
				}
			}else{
				throw new \ErrorException('No tiene ningún producto en su carrito de compra.');
			}
			#####################################
			// Enviar correo
			#####################################
			
			$datos['nro_orden'] = $resp_op['nro_orden'];
			$datos['email'] = $request->co_email;
			// cliente
			$msg_cliente = $this->enviarCorreo('cliente', $datos, $datos_pd['productos']);
			// admin
			$msg_admin = $this->enviarCorreo('admin', $datos, $datos_pd['productos']);
			// echo "fin";
			// exit();
			DB::commit();
			// limpiar cart
			$userId = 1; 
			\Cart::session($userId)->clear();
			$path = 'checkout/completed/'.$id_op;
			return response()->json(['success' => 1, 'path' => $path ], 200);

		}catch(Exception $e){
			DB::rollBack();
			return response()->json(['success' => 0, 'message' => $e->getMessage()]);
		}
	}

	public function enviarCorreo($tipo, $datos, $productos){
		
		$ubigeo = CheckoutOrders::getUbigeo();
		$direccion = $ubigeo->where('ubigeo', $datos['ubigeo'])->first();
		// if($tipo == 'cliente'){
			
			$datos['title'] = 'COMPRA REALIZADA CON ÉXITO';

			$mensaje = "<p>Hola {$datos['nombre']},</p>";
			$mensaje .= "<p>Recibimos la solicitud de compra que realizaste en nuestro sitio; tu número de orden es <b>N° {$datos['nro_orden']}</b>.</p>";	

		// }else{
		// 	$datos['title'] = 'COMPRA REALIZADA CON ÉXITO';
		// 	// $datos['email'] = $request->co_email;
		// 	$datos['subject'] = 'Se registro la compra #'.$datos['nro_orden']. ' ' . date('d/m/Y');
		// 	$mensaje = "<p>Se registro la compra {$datos['nro_orden']}.</p>";
		// }

		$mensaje .= "<table style='' border='0' cellpadding='0' cellspacing='0' width='100%'>";
		$mensaje .= "<tr>";
		$mensaje .= "<td>Nro Compra:</td>";
		$mensaje .= "<td>{$datos['nro_orden']}</td>";
		$mensaje .= "</tr>";
		$mensaje .= "<tr>";
		$mensaje .= "<td>Fecha Compra:</td>";
		$mensaje .= "<td>".date('d/m/Y')."</td>";
		$mensaje .= "</tr>";
		$mensaje .= "<tr>";
		$mensaje .= "<td>Total:</td>";
		$mensaje .= "<td>S/ {$datos['total' ]}</td>";
		$mensaje .= "</tr>";
		$mensaje .= "<tr>";
		$mensaje .= "<td>Dirección:</td>";
		$mensaje .= "<td>{$direccion->descripcion}</td>";
		$mensaje .= "</tr>";
		$mensaje .= "<tr>";
		$mensaje .= "<td>Calle:</td>";
		$mensaje .= "<td>{$datos['calle_direccion']}</td>";
		$mensaje .= "</tr>";
		$mensaje .= "<tr>";
		$mensaje .= "<td>Número:</td>";
		$mensaje .= "<td>{$datos['numero_direccion']}</td>";
		$mensaje .= "</tr>";
		$mensaje .= "<tr>";
		$mensaje .= "<td>Referencia:</td>";
		$mensaje .= "<td>{$datos['referencia_direccion']}</td>";
		$mensaje .= "</tr>";
		$mensaje .= "</table>";

		$url = url('/');
		$mensaje .= "</br>";
		$mensaje .= "<table  id='fr-table' style='' border='0' cellpadding='0' cellspacing='0' width='100%'>";
		$mensaje .= "<thead>";
		$mensaje .= "<tr>";
		$mensaje .= "<th>Producto</th>";
		$mensaje .= "<th>Descripción</th>";
		$mensaje .= "<th>Cantidad</th>";
		$mensaje .= "<th>Total</th>";
		$mensaje .= "</tr>";
		$mensaje .= "</thead>";
		foreach($productos as $row){
			$mensaje .= "<tr>";
			$image = $url.'/public/images/productos/'.$row->url_producto;
			$mensaje .= "<td align='center'><img width='120' src='{$image}'></td>";
			$mensaje .= "<td>{$row->titulo}</td>";
			$mensaje .= "<td align='center'>{$row->quantity}</td>";
			$mensaje .= "<td align='right'>".number_format(($row->precio_unitario * $row->quantity),2)."</td>";
			$mensaje .= "</tr>";
		}
		$mensaje .= "</table>";

		$mensaje .= "<p>Gracias por realizar su compra en <a href='{$url}'>http://minimarket.test/</a></p>";

		$mensaje .= "<p>Saludos Cordiales</p>";

		$datos['mensaje'] = $mensaje;

		// Correo Cliente / Invitado
		if($tipo == 'cliente'){
			$datos['subject'] = 'Compra realizada';
			$datos['cc'] = (env('EMAIL_ADMIN') != '') ? explode(',', env('EMAIL_ADMIN')) : [];
			$send = Mail::send('emails.template', $datos, function($message) use ($datos){
				$message->to($datos['email'] , $datos['nombre'])->cc($datos['cc'])->subject($datos['subject']);
			});
		}else{ // Correo Administrador

			// imagen 
			$files = [];
			if($datos['tipo_pago'] == 1){
				$files = [
					public_path('imagen_transferencia').'/'.$datos['imagen_tranferencia' ],
				];
			}

			$datos['subject'] = 'Compra realizada #'.$datos['nro_orden'];
			$datos['email'] = (env('EMAIL_ADMIN') != '') ? explode(',', env('EMAIL_ADMIN')) : [];
			$datos['cc'] = [];
			$send = Mail::send('emails.template', $datos, function($message) use ($datos, $files){
				$message->to($datos['email'] , $datos['nombre'])->cc($datos['cc'])->subject($datos['subject']);
				foreach ($files as $file){
					$message->attach($file);
				}
			});
		}
		return $send;
	}

	public function completed($idOp = ''){
		$ordenPedido = CheckoutOrders::ordenPedido($idOp, '');
		if(!$ordenPedido){
			return redirect('/');
		}
		$fecha = strtotime('now');
		$fecha_registro = strtotime(date("Y-m-d H:i:s", strtotime($ordenPedido->fechaIn .'+ 2 minutes')));
		// validar fecha
		if($fecha > $fecha_registro){
			return redirect('/');
		}
		$this->data['ordenPedido'] = $ordenPedido;
		return view('checkout-orders.completed', $this->data);
    }
}
?>