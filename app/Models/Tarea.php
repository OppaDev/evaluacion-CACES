<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'tareas';

    protected $fillable = [
        'ind_id',
        'eva_id',
        'tarea',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'responsable',
        'link'
    ];

    public function indicador()
    {
        return $this->belongsTo(Indicador::class, 'ind_id');
    }
    public function evaluacion()
    {
        return $this->belongsTo(Evaluacion::class, 'eva_id');
    }
    public function responsable_user()
    {
        return $this->belongsTo(User::class, 'responsable');
    }
}
