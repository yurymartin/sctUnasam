<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    use SoftDeletes;
    protected $table = 'empleados';
    protected $fillable = ['dni', 'nombres', 'apellidos', 'edad', 'genero', 'condicion_id', 'activo'];
    protected $hidden = ['created_at', 'updated_at'];

    public function condiciones()
    {
        return $this->belongsTo(Condicion::class, 'condicion_id');
    }

    public function temperaturas()
    {
        return $this->hasMany(Temperatura::class, 'id');
    }

    public function Users()
    {
        return $this->hasMany(User::class, 'id');
    }

    public function scopeActivo($query)
    {
        return $query->where('empleados.activo', '1');
    }

    public function scopeBuscar($query, $buscar)
    {
        if ($buscar) {
            $query =  $query->orWhere('empleados.dni', 'LIKE', "%$buscar%");
        }
        if ($buscar) {
            $query = $query->orWhere('empleados.nombres', 'LIKE', "%$buscar%");
        }
        if ($buscar) {
            $query = $query->orWhere('empleados.Apellidos', 'LIKE', "%$buscar%");
        }
        return $query;
    }
}
