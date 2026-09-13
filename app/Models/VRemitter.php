<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VRemitter
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
 * @package App\Models
 */
class VRemitter extends Model
{
	protected $table = 'vRemitter';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idremitter' => 'int'
	];

	protected $fillable = [
		'idremitter',
		'number',
		'name',
		'lastnamep',
		'lastnamem',
		'address',
		'phone',
		'email'
	];
}
