<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TcRemitter
 * 
 * @property int $idremitter
 * @property string|null $number
 * @property string $name
 * @property string $lastnamep
 * @property string $lastnamem
 * @property string $address
 * @property string|null $phone
 * @property string|null $email
 * 
 * @property Collection|Ordene[] $ordenes
 *
 * @package App\Models
 */
class TcRemitter extends Model
{
	protected $table = 'tc_remitter';
	protected $primaryKey = 'idremitter';
	public $timestamps = false;

	protected $fillable = [
		'number',
		'name',
		'lastnamep',
		'lastnamem',
		'address',
		'phone',
		'email'
	];

	public function ordenes()
	{
		return $this->hasMany(Ordene::class, 'idremitter');
	}
}
