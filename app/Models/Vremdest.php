<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Vremdest
 * 
 * @property int $idremdest
 * @property string|null $ci
 * @property string $nombre
 * @property string|null $apellidop
 * @property string|null $apellidom
 * @property string|null $nacionalidad
 * @property string|null $pasaporte
 * @property string $telefono
 * @property string|null $calle
 * @property string $no_calle
 * @property string|null $apto
 * @property string|null $entrecalle
 * @property string $provincia
 * @property string $municipio
 * @property string $cp
 * @property string|null $email
 *
 * @package App\Models
 */
class Vremdest extends Model
{
	protected $table = 'vremdest';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idremdest' => 'int'
	];

	protected $fillable = [
		'idremdest',
		'ci',
		'nombre',
		'apellidop',
		'apellidom',
		'nacionalidad',
		'pasaporte',
		'telefono',
		'calle',
		'no_calle',
		'apto',
		'entrecalle',
		'provincia',
		'municipio',
		'cp',
		'email'
	];
}
