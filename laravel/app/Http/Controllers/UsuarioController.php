<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use \PHPMailer;
use App\Models\Productos;
use App\Models\CheckoutOrders;
use App\Models\Categorias;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class UsuarioController extends Controller
{
	public function __construct(){
		$categorias = Categorias::all();
		$this->data['categorias'] = $categorias;
	}
	
	public function userpersonal(){
		// Datos de Cliente
		$user = Auth::user();
		$ubigeo = CheckoutOrders::getUbigeo();
		
		$this->data['cliente'] = $user;
		$this->data['ubigeo'] = $ubigeo;

		return view('usuario.registro', $this->data);
	}

	public function updateUser(Request $request){

		$validator = Validator::make($request->all(), [
			'co_nombre' => 'required',			
			'co_apellidos' => 'required',
			'co_celular' => 'required|numeric|digits:9',
			'co_ubigeo' => 'required',
			'co_calle_direccion' => 'required',
			'co_numero_direccion' => 'required',
			'co_referencia_direccion' => 'required',
		],[],[
			'co_nombre' => 'Nombre',
			'co_apellidos' => 'Apellidos',
			'co_celular' => 'Celular',
			'co_ubigeo' => 'Dirección',
			'co_calle_direccion' => 'Calle',
			'co_numero_direccion' => 'Número',
			'co_referencia_direccion' => 'Referencia',
		]
		);
		$validator->validate();
		try{
			// $item = \Cart::session($this->userCart)->add($idProducto, $producto->titulo, $producto->precio_unitario, $cantidad, $customAttributes);
			DB::beginTransaction();
			$datos = [];
			$user_id = Auth::user()->id;
			$datos['nombre' ] = $request->co_nombre;
			$datos['apellidos' ] = $request->co_apellidos;
			$datos['empresa' ] = $request->co_empresa;
			$datos['celular' ] = $request->co_celular;
			$datos['ubigeo' ] = $request->co_ubigeo;
			$datos['calle_direccion'] = $request->co_calle_direccion;
			$datos['numero_direccion' ] = $request->co_numero_direccion;
			$datos['referencia_direccion' ] = $request->co_referencia_direccion;

			$user = User::updateData($user_id, $datos);

			DB::commit();
			return response()->json(['success' => 1, 'message' => '' ], 200);

		}catch(Exception $e){
			DB::rollBack();
			return response()->json(['success' => 0, 'message' => $e->getMessage()]);
		}
	}

	public function usercompras(){
		$this->data['items'] = 5;
		$this->data['page'] = 1;
		return view('usuario.pedidos', $this->data);
	}

	public function ordersComprasDetail($id = ''){
		$user_id = Auth::user()->id;
		$ordenPedido = CheckoutOrders::ordenPedido($id, $user_id);
		if(!$ordenPedido){
            return redirect('/');
        }
		
		$ubigeo = CheckoutOrders::getUbigeo();
		$direccion = $ubigeo->where('ubigeo', $ordenPedido->ubigeo)->first();
		$ordenPedidoDetalle = CheckoutOrders::ordenPedidoDetalle($id);
		$this->data['ordenPedido'] = $ordenPedido;
		$this->data['ordenPedidoDetalle'] = $ordenPedidoDetalle;
		$this->data['direccion'] = $direccion;
		return view('usuario.pedidos-detalle', $this->data);
	}

	public function ordersCompras(Request $request){
		$page = (isset($request->page) && $request->page != '') ? $request->page : 1;
		$items = (isset($request->items) && $request->items != '') ? $request->items : 2;

		$search = $request->search;
		$date = $request->date;
		$user_id = Auth::user()->id;

		$result = CheckoutOrders::listaCompraUser($page, $items, $search, $date, $user_id);
		$total = $result['total'];
		$data = $result['data'];
		$pages = ceil($total / $items);
		return response()->json(['success' => 1, 'data' => $data, 'items' => $items, 'pages' => $pages, 'total' => $total ], 200);
	}
}