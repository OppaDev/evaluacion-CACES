<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ElementoFundamental
 * 
 * @property int $id
 * @property int $ind_id
 * @property string|null $elemento
 * @property float|null $porcentaje
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Indicador $indicador
 * @property Collection|Resultado[] $resultados
 *
 * @package App\Models
 */
class ElementoFundamental extends Model
{
	protected $table = 'elemento_fundamentals';

	protected $casts = [
		'ind_id' => 'int',
		'porcentaje' => 'float'
	];

	protected $fillable = [
		'elemento',
		'porcentaje'
	];

	public function indicador()
	{
		return $this->belongsTo(Indicador::class, 'ind_id');
	}

	public function resultados()
	{
		return $this->hasMany(Resultado::class, 'ele_id');
	}
}
