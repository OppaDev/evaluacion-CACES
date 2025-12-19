<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResIndicador extends Model
{
    use HasFactory;
    protected $table = 'res_indicadors';
	public $timestamps = false;

	protected $casts = [
		'eva_id' => 'int',
		'ind_id' => 'int'
	];

	protected $fillable = [
		'eva_id',
		'ind_id',
		'debilidades',
		'fortalezas',
		'nudo',
		'justificacion',
		'resultado'
	];

    public function indicador()
	{
		return $this->belongsTo(Indicador::class, 'ind_id');
	}

    public function evaluacion()
	{
		return $this->belongsTo(Evaluacion::class, 'eva_id');
	}

}
