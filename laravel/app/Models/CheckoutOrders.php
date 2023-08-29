<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CheckoutOrders extends Model
{

	public static function getUbigeo(){
		$resp = DB::table('ubigeo_distritos as uds')
			->join('ubigeo_departamentos as dpt', 'uds.department_id', '=', 'dpt.id')
			->join('ubigeo_provincias as prov', 'uds.province_id', '=', 'prov.id')
			->select([
				'uds.id as ubigeo',
				DB::raw("concat(dpt.name, ' / ', prov.name, ' / ' ,uds.name) as descripcion")
			])
			->get();
		return $resp;
	}

	public static function registrar($datos){
		$id = DB::table('orden_pedidos')
			->insertGetId($datos);
		# número de orden
		$nro_orden = str_pad($id, 8, "0", STR_PAD_LEFT);
		// actualizar
		DB::table('orden_pedidos')->where('id', $id)->update(['nro_orden' => $nro_orden]);
		return ['id' => $id, 'nro_orden' => $nro_orden];
	}

	public static function registrarDetalle($arr_dp){
		return DB::table('orden_pedido_detalle')
			->insertGetId($arr_dp);
	}

	public static function ordenPedido($idOp, $user_id=''){
		$query = DB::table('orden_pedidos as op')
			->join('moneda as m','op.id_moneda', '=', 'm.id')
			->select(['op.id',
			'op.nombre',
			'op.apellidos',
			'op.nro_orden',
			'op.empresa',
			'op.celular',
			'op.email',
			'op.ubigeo',
			'op.calle_direccion',
			'op.numero_direccion',
			'op.referencia_direccion',
			'op.tipo_comprobante',
			'op.nro_documento',
			'op.tipo_pago',
			'op.id_cuenta_bancaria',
			'op.imagen_tranferencia',
			'op.id_moneda',
			'op.subtotal',
			'op.envio_pedido',
			'op.total',
			'op.idcliente',
			'op.fechaIn',
			'op.estado_pedido',
			'm.simbolo',
			'm.descripcion as desc_moneda',
			DB::raw('date_format(op.fechaIn, "%d/%m/%Y") as fecha_compra'),
			DB::raw('(select count(1) from orden_pedido_detalle where id_op = op.id) as total_productos'),
			DB::raw('(select descripcion from estados_admin est where est.codigo = op.estado_pedido and est.estado=1 limit 1) as desc_estado'),
			DB::raw('(select descripcion from tipos_pagos tp where tp.codigo = op.tipo_pago and tp.estado = 1 limit 1) as tipo_pago_desc'),
		])
		->where('op.id', $idOp);

		if($user_id != ''){
			$query = $query->where('op.idcliente', $user_id);
		}
		return $query->first();
	}

	public static function ordenPedidoDetalle($idOp){
		return DB::table('orden_pedido_detalle as od')
			->join('productos as p','od.id_producto', '=', 'p.id')
			->select(['od.id_d',
			'od.id_producto',
			'od.producto',
			'od.precio_unitario',
			'od.cantidad',
			'od.subtotal',
			'od.total',
			'p.categoria_id',
			DB::raw('(select descripcion from moneda m where m.id = od.id_moneda and m.estado=1 limit 1) as desc_moneda'),
			DB::raw('(select simbolo from moneda m where m.id = od.id_moneda and m.estado=1 limit 1) as moneda_simbolo'),
			DB::raw('(select url from productos_imagen img where img.id_producto = p.id and img.principal=1 and img.estado=1 limit 1) as url_producto'),
		])
		->where('od.id_op', $idOp)
		->get();
	}
	
	public static function listaCompraUser($page, $items, $search, $date, $user_id){
		$query = DB::table('orden_pedidos as op')
				->join('moneda as m','op.id_moneda', '=', 'm.id')
				->select(['op.id',
				'op.nombre',
				'op.apellidos',
				'op.nro_orden',
				'op.empresa',
				'op.celular',
				'op.ubigeo',
				'op.tipo_comprobante',
				'op.nro_documento',
				'op.tipo_pago',
				'op.id_cuenta_bancaria',
				'op.id_moneda',
				// 'op.subtotal',
				'op.envio_pedido',
				'op.total',
				'm.simbolo',
				'm.descripcion as desc_moneda',
				DB::raw('date_format(op.fechaIn, "%d/%m/%Y") as fecha_compra'),
				DB::raw('(select count(1) from orden_pedido_detalle where id_op = op.id) as total_productos'),
				DB::raw('(select descripcion from tipos_pagos tp where tp.codigo = op.tipo_pago limit 1) as tipo_pago_desc'),
				DB::raw('(select descripcion from estados_admin est where est.codigo = op.estado_pedido and est.estado=1 limit 1) as desc_estado'),
			])
			->where('op.idcliente', $user_id);
		if($search != ''){
			$query = $query->where('op.nro_orden', $search);
		}
		if($date != ''){
			$query = $query->whereRaw("year(op.fechaIn) = {$date}");
		}
		$total = count($query->get());
		$query = $query->orderBy('op.id', 'desc')->limit($items)->offset(($page - 1) * $items)->get();
		return ['data' => $query, 'total' => $total];
	}
}