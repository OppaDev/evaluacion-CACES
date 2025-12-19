<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subcriterio
 * 
 * @property int $id
 * @property int $cri_id
 * @property string|null $subcriterio
 * @property float|null $porcentaje
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Criterio $criterio
 * @property Collection|Indicador[] $indicadors
 *
 * @package App\Models
 */
class Subcriterio extends Model
{
	protected $table = 'subcriterios';

	protected $casts = [
		'cri_id' => 'int',
		'porcentaje' => 'float'
	];

	protected $fillable = [
		'subcriterio',
		'porcentaje'
	];

	public function criterio()
	{
		return $this->belongsTo(Criterio::class, 'cri_id');
	}

	public function indicadors()
	{
		return $this->hasMany(Indicador::class, 'sub_id');
	}
}
