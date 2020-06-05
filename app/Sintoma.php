<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sintoma extends Model
{
    use SoftDeletes;
    protected $table = 'sintomas';
    protected $fillable = ['sintoma', 'activo'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function detalle_sintomas()
    {
        return $this->hasMany(Detalle_Sintoma::class, 'id');
    }

    public function scopeActivo($query)
    {
        return $query->where('activo', '1');
    }

    public function scopeBuscar($query, $buscar)
    {
        if ($buscar) {
            $query = $query->where('sintoma', 'LIKE', "%$buscar%");
        }
        return $query;
    }
}
