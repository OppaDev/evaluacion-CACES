<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserHasUniversidad
 * 
 * @property int $uni_id
 * @property int $use_id
 * 
 * @property Universidad $universidad
 * @property User $user
 *
 * @package App\Models
 */
class UserHasUniversidad extends Model
{
	protected $table = 'user_has_universidads';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'uni_id' => 'int',
		'use_id' => 'int'
	];

	public function universidad()
	{
		return $this->belongsTo(Universidad::class, 'uni_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'use_id');
	}
	
}
