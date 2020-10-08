<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status_Horario extends Model
{
    protected $table = 'status_horario';
    protected $fillable = ['status', 'description'];
    protected $hidden = ['created_at', 'updated_at'];

    public function horario_medico()
    {
        return $this->hasMany(Horario_Medico::class, 'id');
    }

    public function scopeBuscar($query, $buscar)
    {
        if ($buscar) {
            $query = $query->where('description', 'LIKE', "%$buscar%");
        }
        return $query;
    }
}
