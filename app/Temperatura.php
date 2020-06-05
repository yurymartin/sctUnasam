<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Temperatura extends Model
{
    use SoftDeletes;
    protected $table = 'temperaturas';
    protected $fillable = ['persona_id', 'temperatura', 'fecha', 'hora', 'estado', 'activo'];
    protected $hidden = ['created_at', 'updated_at'];

    public function scopeActivo($query)
    {
        return $query->where('temperatura.activo', '1');
    }

    public function personas()
    {
        return $this->belongsTo(Persona::class, 'persona_id');
    }

    public function scopeBuscar($query, $buscar, $date)
    {
        if ($buscar) {
            $query = $query->where('temperatura', 'LIKE', "%$buscar%");
        }
        $query = $query->where('fecha', '=', $date);
        return $query;
    }
}
