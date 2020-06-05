<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unida_Organica extends Model
{
    use SoftDeletes;
    protected $table = 'unidades_organicas';
    protected $fillable = ['organo_id', 'unidad', 'slug', 'activo'];
    protected $hidden = ['created_at', 'updated_at'];

    public function scopeActivo($query)
    {
        return $query->where('activo', '1');
    }

    public function organos()
    {
        return $this->belongsTo(Organo::class, 'organo_id');
    }

    public function scopeBuscar($query, $buscar)
    {
        if ($buscar) {
            $query = $query->where('unidad', 'LIKE', "%$buscar%");
        }
        return $query;
    }
}
