<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Archivo
 * 
 * @property int $id
 * @property string|null $archivo
 * @property string|null $observacion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|ArcFueEva[] $arc_fue_evas
 *
 * @package App\Models
 */
class Archivo extends Model
{
	protected $table = 'archivos';

	protected $fillable = [
		'archivo',
		'observacion'
	];

	public function arc_fue_evas()
	{
		return $this->hasMany(ArcFueEva::class, 'arc_id');
	}
}
