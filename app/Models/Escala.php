<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Escala
 * 
 * @property int $id
 * @property string|null $escala
 * @property float|null $porcentaje
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Resultado[] $resultados
 *
 * @package App\Models
 */
class Escala extends Model
{
	protected $table = 'escalas';

	protected $casts = [
		'porcentaje' => 'float'
	];

	protected $fillable = [
		'escala',
		'porcentaje'
	];

	public function resultados()
	{
		return $this->hasMany(Resultado::class, 'esc_id');
	}
}
