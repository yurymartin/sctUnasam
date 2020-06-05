<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detalle_Ficha extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $table = 'detalle_fichas';
    protected $fillable = ['persona_id', 'unidades_organica_id', 'fecha', 'hora'];

    public function personas()
    {
        return $this->belongsTo(Persona::class, 'persona_id');
    }

    public function unidades_organicas()
    {
        return $this->belongsTo(unidades_organicas::class, 'unidades_organica_id');
    }
}
