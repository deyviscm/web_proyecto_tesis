<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use Darryldecode\Cart\CartCondition;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Categorias;

class CartController extends Controller
{

	public function __construct(){
		$this->userCart = 1;
		$categorias = Categorias::all();
        $this->data['categorias'] = $categorias;
	}

	public function index()
	{
		$userId = 1; // get this from session or wherever it came from
		$data = [];
		$productos = [];

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
		$condition1 = new \Darryldecode\Cart\CartCondition(array(
			'name' => 'envio-domicilio',
			'type' => 'shipping',
			'target' => 'total',
			'value' => '+20',
			'order' => 1
		));

		\Cart::condition($condition1);

		$totales = array(
			'envio_domicilio' => \Cart::getCondition('envio-domicilio'),
			'total_quantity' => \Cart::session($userId)->getTotalQuantity(),
			'sub_total' => \Cart::session($userId)->getSubTotal(),
			'total' => \Cart::session($userId)->getTotal(),
		);
		// print_r("<pre>".print_r($totales['envio_domicilio']->getValue(), true)."</pre>");
		// exit();
		// Datos de Cliente
		$user = Auth::user();
		$this->data['tipo_user'] = 'CLIENTE';
		if(is_null($user)){
			$this->data['tipo_user'] = 'INVITADO';
		}

		$this->data['productos'] = $listaProductos;
		$this->data['totales'] = $totales;
		return view('cart.index', $this->data);
	}

	public function addItem(Request $request)
	{
		$userId = 1; // get this from session or wherever it came from
		$idProducto = $request->id_producto;
		$producto = Productos::getProducto('','',$idProducto);
		$cantidad = isset($request->cantidad) ? $request->cantidad : 1;

		$customAttributes = [
			// 'color_attr' => [
			//     'label' => 'red',
			//     'price' => 10.00,
			// ],
			// 'size_attr' => [
			//     'label' => 'xxl',
			//     'price' => 15.00,
			// ]
		];

		try{
			$item = \Cart::session($this->userCart)->add($idProducto, $producto->titulo, $producto->precio_unitario, $cantidad, $customAttributes);

			return response()->json(['success' => 1, 'data' => $item, 'message' => 'Se agrego el producto correctamente.'], 200);

		}catch(Exception $e){
			return response()->json(['success' => 0, 'message' => $e->getMessage()]);
		}
	}

	public function updateItem(Request $request)
	{
		Validator::make($request->all(),[
			'id_producto' => ['required'],
			'cantidad' => ['required']
		])->validate();

		$userId = 1; // get this from session or wherever it came from
		$idProducto = $request->id_producto;
		$producto = Productos::getProducto('','',$idProducto);
		$cantidad = $request->cantidad;

		$customAttributes = [];

		try{
			if($cantidad > 0){
				// $item = \Cart::session($this->userCart)->add($idProducto, $producto->titulo, $producto->precio_unitario, $cantidad, $customAttributes);
				$item = \Cart::session($userId)->update($idProducto,
					[
						'quantity' =>  array(
							'relative' => false,
							'value' => $cantidad
						)
					]
				);
			}else{
				$item = \Cart::session($userId)->remove($idProducto);
			}

			return response()->json(['success' => 1, 'data' => $item, 'message' => 'Se agrego el producto correctamente.'], 200);

		}catch(Exception $e){
			return response()->json(['success' => 0, 'message' => $e->getMessage()]);
		}
	}

	public function removeItem(Request $request)
	{
		Validator::make($request->all(),[
			'id_producto' => ['required']
		])->validate();

		$userId = 1; // get this from session or wherever it came from
		$id = $request->id_producto;
		try{
			\Cart::session($userId)->remove($id);
			return response()->json(['success' => 1], 200);

		}catch(Exception $e){
			return response()->json(['success' => 0, 'message' => $e->getMessage()]);
		}
	}

	public function orders(Request $request){
		if (Auth::check()) {
			return response()->json(['success' => 1, 'path' => 'checkout/orders'], 200);
		}else{
			return response()->json(['success' => 0, 'path' => ''], 200);
		}
	}

	public function addCondition()
	{
		$userId = 1; // get this from session or wherever it came from

		/** @var \Illuminate\Validation\Validator $v */
		$v = validator(request()->all(),[
			'name' => 'required|string',
			'type' => 'required|string',
			'target' => 'required|string',
			'value' => 'required|string',
		]);

		if($v->fails())
		{
			return response(array(
				'success' => false,
				'data' => [],
				'message' => $v->errors()->first()
			),400,[]);
		}

		$name = request('name');
		$type = request('type');
		$target = request('target');
		$value = request('value');

		$cartCondition = new CartCondition([
			'name' => $name,
			'type' => $type,
			'target' => $target, // this condition will be applied to cart's subtotal when getSubTotal() is called.
			'value' => $value,
			'attributes' => array()
		]);

		\Cart::session($userId)->condition($cartCondition);

		return response(array(
			'success' => true,
			'data' => $cartCondition,
			'message' => "condition added."
		),201,[]);
	}

	public function clearCartConditions()
	{
		$userId = 1; // get this from session or wherever it came from

		\Cart::session($userId)->clearCartConditions();

		return response(array(
			'success' => true,
			'data' => [],
			'message' => "cart conditions cleared."
		),200,[]);
	}

	public function details()
	{
		$userId = 1; // get this from session or wherever it came from

		// get subtotal applied condition amount
		$conditions = \Cart::session($userId)->getConditions();


		// get conditions that are applied to cart sub totals
		$subTotalConditions = $conditions->filter(function (CartCondition $condition) {
			return $condition->getTarget() == 'subtotal';
		})->map(function(CartCondition $c) use ($userId) {
			return [
				'name' => $c->getName(),
				'type' => $c->getType(),
				'target' => $c->getTarget(),
				'value' => $c->getValue(),
			];
		});

		// get conditions that are applied to cart totals
		$totalConditions = $conditions->filter(function (CartCondition $condition) {
			return $condition->getTarget() == 'total';
		})->map(function(CartCondition $c) {
			return [
				'name' => $c->getName(),
				'type' => $c->getType(),
				'target' => $c->getTarget(),
				'value' => $c->getValue(),
			];
		});

		return response(array(
			'success' => true,
			'data' => array(
				'total_quantity' => \Cart::session($userId)->getTotalQuantity(),
				'sub_total' => \Cart::session($userId)->getSubTotal(),
				'total' => \Cart::session($userId)->getTotal(),
				'cart_sub_total_conditions_count' => $subTotalConditions->count(),
				'cart_total_conditions_count' => $totalConditions->count(),
			),
			'message' => "Get cart details success."
		),200,[]);
	}
}