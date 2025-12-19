<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Formula
 * 
 * @property int $id
 * @property int $ind_id
 * @property string|null $formula
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Indicador $indicador
 * @property Collection|Indicador[] $indicadors
 * @property Collection|Resultado[] $resultados
 *
 * @package App\Models
 */
class Formula extends Model
{
	protected $table = 'formulas';

	protected $casts = [
		'ind_id' => 'int'
	];

	protected $fillable = [
		'formula'
	];

	public function indicador()
	{
		return $this->belongsTo(Indicador::class, 'ind_id');
	}

	public function indicadors()
	{
		return $this->hasMany(Indicador::class, 'for_id');
	}

	public function resultados()
	{
		return $this->hasMany(Resultado::class, 'for_id');
	}
}
