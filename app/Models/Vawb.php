<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Vawb
 * 
 * @property string $no_embarque
 * @property string $shipper
 * @property string|null $shipid
 * @property string|null $shiptelefono
 * @property string|null $dirshipper
 * @property string|null $shipemail
 * @property string|null $consignee
 * @property string|null $ci
 * @property string $telefono
 * @property string|null $direccion
 * @property string|null $email
 * @property string $municipio
 * @property string $provincia
 * @property string $aeronave
 * @property string $vuelo
 * @property string $portorigen
 * @property string $origen
 * @property string $portdestino
 * @property string $destino
 * @property string $nombre
 * @property string $dir
 * @property string|null $contenedor
 * @property string|null $descripcion
 * @property string|null $cantidadpiezas
 * @property int $bulto
 * @property int|null $cantidad
 * @property float|null $gross
 * @property float|null $m3
 * @property string|null $mawb
 * @property string|null $hawb
 * @property int $idorden
 * @property string|null $estado
 * @property Carbon|null $fecha
 * @property string $codigoenvio
 * @property string $aerolinea
 * @property string $rutas
 *
 * @package App\Models
 */
class Vawb extends Model
{
	protected $table = 'vawb';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'bulto' => 'int',
		'cantidad' => 'int',
		'gross' => 'float',
		'm3' => 'float',
		'idorden' => 'int'
	];

	protected $dates = [
		'fecha'
	];

	protected $fillable = [
		'no_embarque',
		'shipper',
		'shipid',
		'shiptelefono',
		'dirshipper',
		'shipemail',
		'consignee',
		'ci',
		'telefono',
		'direccion',
		'email',
		'municipio',
		'provincia',
		'aeronave',
		'vuelo',
		'portorigen',
		'origen',
		'portdestino',
		'destino',
		'nombre',
		'dir',
		'contenedor',
		'descripcion',
		'cantidadpiezas',
		'bulto',
		'cantidad',
		'gross',
		'm3',
		'mawb',
		'hawb',
		'idorden',
		'estado',
		'fecha',
		'codigoenvio',
		'aerolinea',
		'rutas'
	];
}
