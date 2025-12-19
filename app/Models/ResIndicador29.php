<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResIndicador29 extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function universidad()
    {
        return $this->belongsTo(Universidad::class, 'uni_id');
    }

    public function evaluacion()
    {
        return $this->belongsTo(Evaluacion::class, 'eva_id');
    }

    public function indicador()
    {
        return $this->belongsTo(Indicador::class, 'ind_id');
    }

    public function ElementoFundamental()
    {
        return $this->belongsTo(ElementoFundamental::class, 'elemento_fundamental_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
