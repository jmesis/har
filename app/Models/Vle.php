<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Vle
 * 
 * @property string|null $master
 * @property string|null $house
 * @property string|null $consignee
 * @property string|null $ci
 * @property string $telefono
 * @property string|null $direccion
 * @property string|null $contenedor
 * @property string $descripcion
 * @property string|null $cantidadpiezas
 * @property float|null $gross
 * @property float|null $m3
 * @property float|null $valor
 *
 * @package App\Models
 */
class Vle extends Model
{
	protected $table = 'vle';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'gross' => 'float',
		'm3' => 'float',
		'valor' => 'float'
	];

	protected $fillable = [
		'master',
		'house',
		'consignee',
		'ci',
		'telefono',
		'direccion',
		'contenedor',
		'descripcion',
		'cantidadpiezas',
		'gross',
		'm3',
		'valor'
	];
}
