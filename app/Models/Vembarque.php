<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Vembarque
 * 
 * @property string $no_embarque
 * @property string $origen
 * @property string $codigoorigen
 * @property string $tipoembarque
 * @property string $codigoembarque
 * @property string|null $buque
 * @property string|null $viaje
 * @property string $embarcador
 * @property string $consignado
 * @property int|null $idpol
 * @property int|null $idpod
 * @property string|null $pol
 * @property string|null $pod
 * @property string|null $tipocont
 * @property string|null $contenedor
 * @property string|null $doc
 * @property Carbon|null $fecha_est
 * @property string $estado
 * @property int|null $idnaviera
 * @property string|null $naviera
 * @property int $anno
 *
 * @package App\Models
 */
class Vembarque extends Model
{
	protected $table = 'vembarques';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idpol' => 'int',
		'idpod' => 'int',
		'idnaviera' => 'int',
		'anno' => 'int'
	];

	protected $dates = [
		'fecha_est'
	];

	protected $fillable = [
		'no_embarque',
		'origen',
		'codigoorigen',
		'tipoembarque',
		'codigoembarque',
		'buque',
		'viaje',
		'embarcador',
		'consignado',
		'idpol',
		'idpod',
		'pol',
		'pod',
		'tipocont',
		'contenedor',
		'doc',
		'fecha_est',
		'estado',
		'idnaviera',
		'naviera',
		'anno'
	];
}
