<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserHasIndicador
 * 
 * @property int $ind_id
 * @property int $id
 * 
 * @property Indicador $indicador
 * @property User $user
 *
 * @package App\Models
 */
class UserHasIndicador extends Model
{
	protected $table = 'user_has_indicadors';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ind_id' => 'int',
		'id' => 'int'
	];

	public function indicador()
	{
		return $this->belongsTo(Indicador::class, 'ind_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id');
	}
}
