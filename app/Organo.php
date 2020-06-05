<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organo extends Model
{
    use SoftDeletes;
    protected $table = 'organos';
    protected $fillable = ['organo', 'slug', 'activo'];
    protected $hidden = ['created_at', 'updated_at'];

    public function scopeActivo($query)
    {
        return $query->where('activo', '1');
    }

    public function unidades_organicas()
    {
        return $this->hasMany(Unida_Organica::class, 'id');
    }

    public function scopeBuscar($query, $buscar)
    {
        if ($buscar) {
            $query = $query->where('organo', 'LIKE', "%$buscar%");
        }
        return $query;
    }
}
