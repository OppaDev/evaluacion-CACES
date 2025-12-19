<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Evaluacion
 * 
 * @property int $id
 * @property int $uni_id
 * @property int $use_id
 * @property Carbon|null $fecha_creacion
 * @property Carbon|null $fecha_inicial
 * @property Carbon|null $fecha_final
 * @property int|null $informe
 * @property string|null $facultad
 * @property string|null $departamento
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Universidad $universidad
 * @property User $user
 * @property Collection|ArcFueEva[] $arc_fue_evas
 * @property Collection|Resultado[] $resultados
 *
 * @package App\Models
 */
class Evaluacion extends Model
{
	protected $table = 'evaluacions';

	protected $casts = [
		'uni_id' => 'int',
		'use_id' => 'int',
		'fecha_creacion' => 'datetime',
		'fecha_inicial' => 'datetime',
		'fecha_final' => 'datetime',
		'informe' => 'int'
	];

	protected $fillable = [
		'fecha_creacion',
		'fecha_inicial',
		'fecha_final',
		'informe',
		'facultad',
		'departamento'
	];

	public function universidad()
	{
		return $this->belongsTo(Universidad::class, 'uni_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'use_id');
	}

	public function arc_fue_evas()
	{
		return $this->hasMany(ArcFueEva::class, 'eva_id');
	}

	public function resultados()
	{
		return $this->hasMany(Resultado::class, 'eva_id');
	}
}
