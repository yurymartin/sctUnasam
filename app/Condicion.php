<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Condicion extends Model
{
    use SoftDeletes;
    protected $table = 'condiciones';
    protected $fillable = ['condicion', 'descripcion', 'activo'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'id');
    }

    public function scopeActivo($query)
    {
        return $query->where('activo', '1');
    }

    public function scopeBuscar($query, $buscar)
    {
        if ($buscar) {
            return $query->orWhere('condicion', 'LIKE', "%$buscar%");
        }
    }
}
