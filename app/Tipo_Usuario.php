<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tipo_Usuario extends Model
{
    use SoftDeletes;
    protected $table = 'tipo_usuarios';
    protected $fillable = ['tipo', 'descripcion', 'activo'];
    protected $hidden = ['created_at', 'updated_at'];

    public function scopeActivo($query)
    {
        return $query->where('activo', '1');
    }

    public function Users()
    {
        return $this->hasMany(User::class, 'id');
    }

    public function scopeBuscar($query, $buscar)
    {
        if ($buscar) {
            $query = $query->where('tipo', 'LIKE', "%$buscar%");
        }
        return $query;
    }
}
