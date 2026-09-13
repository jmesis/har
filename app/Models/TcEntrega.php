<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TcEntrega
 * 
 * @property int $identrega
 * @property string $cod_entrega
 * @property string $detalle
 * 
 * @property Collection|Ordene[] $ordenes
 *
 * @package App\Models
 */
class TcEntrega extends Model
{
	protected $table = 'tc_entrega';
	protected $primaryKey = 'identrega';
	public $timestamps = false;

	protected $fillable = [
		'cod_entrega',
		'detalle'
	];

	public function ordenes()
	{
		return $this->hasMany(Ordene::class, 'identrega');
	}
}
