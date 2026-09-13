<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Vetiquetasmerge
 * 
 * @property string $no_orden
 * @property string $no_embarque
 * @property string $remitente
 * @property string|null $destinatario
 * @property string|null $ci
 * @property string $telefono
 * @property string|null $direccion
 * @property string $provincia
 * @property string $municipio
 * @property string|null $codprovincia
 * @property string $descripcion
 * @property string $cantidadpiezas
 * @property int $bulto
 * @property int|null $cantidad
 * @property string|null $codigobarra
 * @property string|null $noblhouse
 * @property float $pesokg
 * @property int $idproducto
 * @property int $noproducto
 * @property int $idetiqueta
 * @property int $idorden
 * @property string|null $estado
 * @property Carbon $fecha
 * @property string $codigoenvio
 * @property string|null $codigoqr
 * @property string|null $mawb
 * @property string|null $rutas
 *
 * @package App\Models
 */
class Vetiquetasmerge extends Model
{
	protected $table = 'vetiquetasmerge';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'bulto' => 'int',
		'cantidad' => 'int',
		'pesokg' => 'float',
		'idproducto' => 'int',
		'noproducto' => 'int',
		'idetiqueta' => 'int',
		'idorden' => 'int'
	];

	protected $dates = [
		'fecha'
	];

	protected $fillable = [
		'no_orden',
		'no_embarque',
		'remitente',
		'destinatario',
		'ci',
		'telefono',
		'direccion',
		'provincia',
		'municipio',
		'codprovincia',
		'descripcion',
		'cantidadpiezas',
		'bulto',
		'cantidad',
		'codigobarra',
		'noblhouse',
		'pesokg',
		'idproducto',
		'noproducto',
		'idetiqueta',
		'idorden',
		'estado',
		'fecha',
		'codigoenvio',
		'codigoqr',
		'mawb',
		'rutas'
	];
}
