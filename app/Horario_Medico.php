<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Horario_Medico extends Model
{
    use SoftDeletes;
    protected $table = 'horario_medico';
    protected $fillable = ['fecha', 'hora_inicio', 'hora_fin', 'medico_id', 'status_id', 'activo'];
    protected $hidden = ['created_at', 'updated_at'];

    public function scopeActivo($query)
    {
        return $query->where('horario_medico.activo', '1');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'medico_id');
    }

    public function status_horario()
    {
        return $this->belongsTo(Status_Horario::class, 'status_id');
    }

    public function scopeBuscar($query, $buscar, $date)
    {
        if ($buscar) {
            $query = $query->where('status_id', 'LIKE', "%$buscar%");
        }
        $query = $query->where('fecha', '=', $date);
        return $query;
    }
}
