<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Indicador
 * 
 * @property int $id
 * @property int|null $sub_id
 * @property int|null $sub_cri_id
 * @property int|null $for_id
 * @property int|null $ind_id
 * @property int|null $cri_id
 * @property string|null $indicador
 * @property string|null $estandar
 * @property string|null $periodo
 * @property float|null $porcentaje
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Subcriterio|null $subcriterio
 * @property Criterio|null $criterio
 * @property Formula|null $formula
 * @property Collection|ElementoFundamental[] $elemento_fundamentals
 * @property Collection|Formula[] $formulas
 * @property Collection|FuenteInformacion[] $fuente_informacions
 *
 * @package App\Models
 */
class Indicador extends Model
{
	protected $table = 'indicadors';

	protected $casts = [
		'sub_id' => 'int',
		'sub_cri_id' => 'int',
		'for_id' => 'int',
		'ind_id' => 'int',
		'cri_id' => 'int',
		'porcentaje' => 'float'
	];

	protected $fillable = [
		'sub_id',
		'sub_cri_id',
		'for_id',
		'ind_id',
		'cri_id',
		'indicador',
		'estandar',
		'periodo',
		'porcentaje'
	];

	public function subcriterio()
	{
		return $this->belongsTo(Subcriterio::class, 'sub_id');
	}

	public function criterio()
	{
		return $this->belongsTo(Criterio::class, 'cri_id');
	}

	public function formula()
	{
		return $this->belongsTo(Formula::class, 'for_id');
	}

	public function elemento_fundamentals()
	{
		return $this->hasMany(ElementoFundamental::class, 'ind_id');
	}

	public function formulas()
	{
		return $this->hasMany(Formula::class, 'ind_id');
	}

	public function fuente_informacions()
	{
		return $this->hasMany(FuenteInformacion::class, 'ind_id');
	}
	public function resIndicador()
	{
		return $this->hasMany(ResIndicador::class, 'ind_id');
	}
}
