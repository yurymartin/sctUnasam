<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detalle_Sintoma extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $table = 'detalle_sintomas';
    protected $fillable = ['ficha_sintoma_id', 'sintoma_id', 'respuesta'];

    public function fichas_sintomaticas()
    {
        return $this->belongsTo(FichaSintomatica::class, 'ficha_sintoma_id');
    }

    public function sintomas()
    {
        return $this->belongsTo(Sintoma::class, 'sintoma_id');
    }

    public function scopeBuscar($query, $buscar)
    {
        if ($buscar) {
            $query = $query->where('organo', 'LIKE', "%$buscar%");
        }
        return $query;
    }
}
