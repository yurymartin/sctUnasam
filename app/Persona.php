<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use SoftDeletes;
    protected $table = 'personas';
    protected $fillable = ['dni', 'nombres', 'apellidos', 'direccion', 'celular', 'activo'];
    protected $hidden = ['created_at', 'updated_at'];

    public function detalle_condiciones()
    {
        return $this->hasMany(Condicion::class, 'condicion_id');
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
        return $query->where('personas.activo', '1');
    }

    public function scopeBuscar($query, $buscar)
    {
        if ($buscar) {
            $query =  $query->orWhere('personas.dni', 'LIKE', "%$buscar%");
        }
        if ($buscar) {
            $query = $query->orWhere('personas.nombres', 'LIKE', "%$buscar%");
        }
        if ($buscar) {
            $query = $query->orWhere('personas.apellidos', 'LIKE', "%$buscar%");
        }
        return $query;
    }
}
