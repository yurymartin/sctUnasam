<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detalle_Condicion extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $table = 'detalle_condiciones';
    protected $fillable = ['persona_id', 'condicion_id', 'respuesta'];

    public function personas()
    {
        return $this->belongsTo(Persona::class, 'persona_id');
    }

    public function condiciones()
    {
        return $this->belongsTo(Condicion::class, 'condicion_id');
    }
}
