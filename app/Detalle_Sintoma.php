<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detalle_Sintoma extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $table = 'detalle_sintomas';
    protected $fillable = ['persona_id', 'sintoma_id', 'respuesta'];

    public function personas()
    {
        return $this->belongsTo(Persona::class, 'persona_id');
    }

    public function sintomas()
    {
        return $this->belongsTo(Sintoma::class, 'sintoma_id');
    }
}
