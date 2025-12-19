<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FuenteInformacion
 * 
 * @property int $id
 * @property int $ind_id
 * @property string|null $documento
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Indicador $indicador
 * @property Collection|ArcFueEva[] $arc_fue_evas
 *
 * @package App\Models
 */
class FuenteInformacion extends Model
{
	protected $table = 'fuente_informacions';

	protected $casts = [
		'ind_id' => 'int'
	];

	protected $fillable = [
		'documento'
	];

	public function indicador()
	{
		return $this->belongsTo(Indicador::class, 'ind_id');
	}

	public function arc_fue_evas()
	{
		return $this->hasMany(ArcFueEva::class, 'fue_id');
	}
}
