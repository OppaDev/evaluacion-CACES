<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserHasCriterio
 * 
 * @property int $cri_id
 * @property int $id
 * 
 * @property Criterio $criterio
 * @property User $user
 *
 * @package App\Models
 */
class UserHasCriterio extends Model
{
	protected $table = 'user_has_criterios';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cri_id' => 'int',
		'id' => 'int'
	];

	public function criterio()
	{
		return $this->belongsTo(Criterio::class, 'cri_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id');
	}
}
