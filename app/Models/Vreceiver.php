<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Vreceiver
 * 
 * @property int $id
 * @property string|null $number
 * @property string $name
 * @property string|null $lastnamep
 * @property string|null $lastnamem
 * @property string|null $address
 * @property string $phone
 * @property string|null $email
 * @property string $identify
 *
 * @package App\Models
 */
class Vreceiver extends Model
{
	protected $table = 'vreceiver';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'id',
		'number',
		'name',
		'lastnamep',
		'lastnamem',
		'address',
		'phone',
		'email',
		'identify'
	];
}
