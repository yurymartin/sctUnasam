<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status_Cita extends Model
{
    protected $table = 'status_cita';
    protected $fillable = ['status', 'description'];
    protected $hidden = ['created_at', 'updated_at'];

    public function reservas()
    {
        return $this->hasMany(Reservas::class, 'id');
    }

    public function scopeBuscar($query, $buscar)
    {
        if ($buscar) {
            $query = $query->where('description', 'LIKE', "%$buscar%");
        }
        return $query;
    }
}
