<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Condicion extends Model
{
    use SoftDeletes;
    protected $table = 'condiciones';
    protected $fillable = ['condicion', 'activo'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function detalle_condiciones()
    {
        return $this->hasMany(Detalle_Condicion::class, 'id');
    }

    public function scopeActivo($query)
    {
        return $query->where('activo', '1');
    }

    public function scopeBuscar($query, $buscar)
    {
        if ($buscar) {
            $query = $query->where('condicion', 'LIKE', "%$buscar%");
        }
        return $query;
    }
}
