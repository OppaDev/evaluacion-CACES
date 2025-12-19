<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Universidad
 * 
 * @property int $id
 * @property string|null $universidad
 * @property string|null $foto
 * @property string|null $campus
 * @property string|null $sede
 * @property string|null $ciudad
 * @property string|null $informe
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Evaluacion[] $evaluacions
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Universidad extends Model
{
	protected $table = 'universidads';

	protected $fillable = [
		'universidad',
		'foto',
		'campus',
		'sede',
		'ciudad',
		'informe'
	];

	public function evaluacions()
	{
		return $this->hasMany(Evaluacion::class, 'uni_id');
	}

	public function users()
	{
		return $this->belongsToMany(User::class, 'user_has_universidads', 'uni_id', 'use_id');
	}
}
