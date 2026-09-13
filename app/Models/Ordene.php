<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ordene
 * 
 * @property int $idorden
 * @property int|null $idremitter
 * @property int $idremdest
 * @property int $idembarque
 * @property int $idtenvio
 * @property int|null $identrega
 * @property string $codigoenvio
 * @property string $no_orden
 * @property string $noseq
 * @property string $anno
 * @property string $remitente
 * @property Carbon $fentrada
 * @property string|null $codigo_identificativo
 * @property string $estado
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Embarque $embarque
 * @property TcEntrega|null $tc_entrega
 * @property TcRemDest $tc_rem_dest
 * @property TcRemitter|null $tc_remitter
 * @property TcTipoenvio $tc_tipoenvio
 * @property Collection|Cargo[] $cargos
 * @property Collection|Etiqueta[] $etiquetas
 * @property Collection|FacturaDato[] $factura_datos
 * @property Collection|Producto[] $productos
 *
 * @package App\Models
 */
class Ordene extends Model
{
	protected $table = 'ordenes';
	protected $primaryKey = 'idorden';

	protected $casts = [
		'idremitter' => 'int',
		'idremdest' => 'int',
		'idembarque' => 'int',
		'idtenvio' => 'int',
		'identrega' => 'int'
	];

	protected $dates = [
		'fentrada'
	];

	protected $fillable = [
		'idremitter',
		'idremdest',
		'idembarque',
		'idtenvio',
		'identrega',
		'codigoenvio',
		'no_orden',
		'noseq',
		'anno',
		'remitente',
		'fentrada',
		'codigo_identificativo',
		'estado'
	];

	public function embarque()
	{
		return $this->belongsTo(Embarque::class, 'idembarque');
	}

	public function tc_entrega()
	{
		return $this->belongsTo(TcEntrega::class, 'identrega');
	}

	public function tc_rem_dest()
	{
		return $this->belongsTo(TcRemDest::class, 'idremdest');
	}

	public function tc_remitter()
	{
		return $this->belongsTo(TcRemitter::class, 'idremitter');
	}

	public function tc_tipoenvio()
	{
		return $this->belongsTo(TcTipoenvio::class, 'idtenvio');
	}

	public function cargos()
	{
		return $this->hasMany(Cargo::class, 'idorden');
	}

	public function etiquetas()
	{
		return $this->hasMany(Etiqueta::class, 'idorden');
	}

	public function factura_datos()
	{
		return $this->hasMany(FacturaDato::class, 'idorden');
	}

	public function productos()
	{
		return $this->hasMany(Producto::class, 'idorden');
	}
}
