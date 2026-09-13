<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TcRemDest
 * 
 * @property int $idremdest
 * @property int|null $idprovmcpio
 * @property int|null $idcp
 * @property string|null $ci
 * @property string|null $email
 * @property string $nombre
 * @property string|null $apellidop
 * @property string|null $apellidom
 * @property string|null $nacionalidad
 * @property string|null $nopasaporte
 * @property string $telefono
 * @property string|null $calle
 * @property string $no_calle
 * @property string|null $apto
 * @property string|null $entrecalle
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property TcCp|null $tc_cp
 * @property TcProvMcpio|null $tc_prov_mcpio
 * @property Collection|Ordene[] $ordenes
 *
 * @package App\Models
 */
class TcRemDest extends Model
{
	protected $table = 'tc_rem_dest';
	protected $primaryKey = 'idremdest';

	protected $casts = [
		'idprovmcpio' => 'int',
		'idcp' => 'int'
	];

	protected $fillable = [
		'idprovmcpio',
		'idcp',
		'ci',
		'email',
		'nombre',
		'apellidop',
		'apellidom',
		'nacionalidad',
		'nopasaporte',
		'telefono',
		'calle',
		'no_calle',
		'apto',
		'entrecalle'
	];

	public function tc_cp()
	{
		return $this->belongsTo(TcCp::class, 'idcp');
	}

	public function tc_prov_mcpio()
	{
		return $this->belongsTo(TcProvMcpio::class, 'idprovmcpio');
	}

	public function ordenes()
	{
		return $this->hasMany(Ordene::class, 'idremdest');
	}
}
