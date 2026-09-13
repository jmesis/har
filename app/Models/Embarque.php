<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Embarque
 * 
 * @property int $idembarque
 * @property int|null $idbuque
 * @property int|null $idviaje
 * @property int|null $idpol
 * @property int|null $idpod
 * @property int|null $idcontainer
 * @property int $idembarcador
 * @property int $idconsignado
 * @property int|null $idnaviera
 * @property string|null $nomfto
 * @property string|null $mguia_bl
 * @property string $no_embarque
 * @property string $tipoembarque
 * @property int $anno
 * @property int $noseq
 * @property Carbon|null $fecha_est
 * @property string|null $contenedor
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $estado
 * 
 * @property TcContainer|null $tc_container
 * @property TcViaje|null $tc_viaje
 * @property TcNaviera|null $tc_naviera
 * @property TcPort|null $tc_port
 * @property TcCliente $tc_cliente
 * @property TcBuque|null $tc_buque
 * @property Collection|Ordene[] $ordenes
 *
 * @package App\Models
 */
class Embarque extends Model
{
	protected $table = 'embarques';
	protected $primaryKey = 'idembarque';

	protected $casts = [
		'idbuque' => 'int',
		'idviaje' => 'int',
		'idpol' => 'int',
		'idpod' => 'int',
		'idcontainer' => 'int',
		'idembarcador' => 'int',
		'idconsignado' => 'int',
		'idnaviera' => 'int',
		'anno' => 'int',
		'noseq' => 'int'
	];

	protected $dates = [
		'fecha_est'
	];

	protected $fillable = [
		'idbuque',
		'idviaje',
		'idpol',
		'idpod',
		'idcontainer',
		'idembarcador',
		'idconsignado',
		'idnaviera',
		'nomfto',
		'mguia_bl',
		'no_embarque',
		'origen',
		'tipoembarque',
		'anno',
		'noseq',
		'fecha_est',
		'contenedor',
		'estado'
	];

	public function tc_container()
	{
		return $this->belongsTo(TcContainer::class, 'idcontainer');
	}

	public function tc_viaje()
	{
		return $this->belongsTo(TcViaje::class, 'idviaje');
	}

	public function tc_naviera()
	{
		return $this->belongsTo(TcNaviera::class, 'idnaviera');
	}

	public function tc_port()
	{
		return $this->belongsTo(TcPort::class, 'idpol');
	}

	public function tc_cliente()
	{
		return $this->belongsTo(TcCliente::class, 'idembarcador');
	}

	public function tc_buque()
	{
		return $this->belongsTo(TcBuque::class, 'idbuque');
	}

	public function ordenes()
	{
		return $this->hasMany(Ordene::class, 'idembarque');
	}
}
