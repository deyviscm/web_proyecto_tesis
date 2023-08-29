<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Productos extends Model
{
	protected $table = 'productos';
	public $timestamps = false;

	public function categorias() {
		return $this->belongsTo('App\Models\Categorias', 'categoria_id');
	}

	public static function listaProductos($idCategoria, $producto_url=''){
		$list = DB::table('productos as p')
				->leftJoin('moneda as m', 'p.id_moneda','=','m.id')
				->select([
					'p.titulo',
					'p.categoria_id',
					'p.categoria',
					'p.descripcion',
					DB::raw('if(ifnull(p.precio_unitario,"") <> "", round(p.precio_unitario,2), "") as precio_unitario'),
					'p.id_moneda',
					'p.estado_precio',
					'p.url',
					'p.id',
					DB::raw('if(ifnull(p.id_moneda,"") <> "", m.descripcion, "") as moneda_descripcion'),
					DB::raw('if(ifnull(p.id_moneda,"") <> "", m.simbolo, "") as moneda_simbolo'),
					DB::raw('(select pi.url from productos_imagen as pi where pi.id_producto = p.id and pi.principal=1 limit 1) as imagen'),
				])
				->where('categoria_id', $idCategoria);
		if($producto_url == ''){
			return $list->orderBy('titulo', 'asc')->paginate(9);
		}else{
			return $list->where('url', '!=', $producto_url)
					->orderByRaw('FIELD(categoria_id, "'.$idCategoria.'") DESC')
					->limit(4)
                    ->get();
		}		

	}

	public static function getProducto($idCategoria, $producto_url, $idProducto=''){
		$prod = DB::table('productos as p')
				->leftJoin('moneda as m', 'p.id_moneda','=','m.id')
				->select([
					'p.titulo',
					'p.categoria_id',
					'p.categoria',
					'p.descripcion',
					DB::raw('if(ifnull(p.precio_unitario,"") <> "", round(p.precio_unitario,2), "") as precio_unitario'),
					'p.id_moneda',
					'p.estado_precio',
					// 'p.imagen',
					DB::raw('(select pi.url from productos_imagen as pi where pi.id_producto = p.id and pi.principal=1 limit 1) as imagen'),
					'p.url',
					'p.id',
					DB::raw('if(ifnull(p.id_moneda,"") <> "", m.descripcion, "") as moneda_descripcion'),
					DB::raw('if(ifnull(p.id_moneda,"") <> "", m.simbolo, "") as moneda_simbolo'),
					
				]);
				
		if($idProducto != ''){
			return $prod->where('p.id', $idProducto)->first();
		}else{
			return $prod->where('categoria_id', $idCategoria)->where('url', $producto_url)->first();
		}		

	}

	public static function getImagenes($idProducto){
		return DB::table('productos_imagen')
				->where('id_producto', $idProducto)
				->where('estado', 1)
				->orderBy('principal', 'desc')
				->get();
	}

	public static function listaComprasProductos($idProductos){
		return DB::table('productos as p')
				->leftJoin('moneda as m', 'p.id_moneda','=','m.id')
				->select([
					'p.titulo',
					'p.categoria_id',
					'p.categoria',
					'p.descripcion',
					DB::raw('if(ifnull(p.precio_unitario,"") <> "", round(p.precio_unitario,2), "") as precio_unitario'),
					'p.id_moneda',
					'p.estado_precio',
					// 'p.imagen',
					'p.url',
					'p.id',
					DB::raw('if(ifnull(p.id_moneda,"") <> "", m.descripcion, "") as moneda_descripcion'),
					DB::raw('if(ifnull(p.id_moneda,"") <> "", m.simbolo, "") as moneda_simbolo'),
					DB::raw('(select pi.url from productos_imagen as pi where pi.id_producto = p.id and pi.principal=1 limit 1) as url_producto')
				])
				->whereIn('p.id', $idProductos)
                ->get();		

	}
}