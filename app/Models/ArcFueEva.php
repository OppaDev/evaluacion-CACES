<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ArcFueEva
 * 
 * @property int $arc_id
 * @property int $fue_id
 * @property int $uni_id
 * @property int $use_id
 * @property int $eva_id
 * @property int|null $fue_ind_id
 * 
 * @property Archivo $archivo
 * @property FuenteInformacion $fuente_informacion
 * @property Evaluacion $evaluacion
 *
 * @package App\Models
 */
class ArcFueEva extends Model
{
	protected $table = 'arc_fue_eva';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'arc_id' => 'int',
		'fue_id' => 'int',
		'uni_id' => 'int',
		'use_id' => 'int',
		'eva_id' => 'int',
		'fue_ind_id' => 'int'
	];

	protected $fillable = [
		'fue_ind_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'use_id');
	}

	public function archivo()
	{
		return $this->belongsTo(Archivo::class, 'arc_id');
	}

	public function fuente_informacion()
	{
		return $this->belongsTo(FuenteInformacion::class, 'fue_id');
	}

	public function evaluacion()
	{
		return $this->belongsTo(Evaluacion::class, 'eva_id');
	}
}
