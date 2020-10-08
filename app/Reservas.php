<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservas extends Model
{
    use SoftDeletes;
    protected $table = 'reservas';
    protected $fillable = ['description', 'paciente_id', 'horario_medico_id', 'ficha_sintomatica_id', 'status_id', 'activo'];
    protected $hidden = ['created_at', 'updated_at'];

    public function scopeActivo($query)
    {
        return $query->where('reservas.activo', '1');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'paciente_id');
    }

    public function horario_medico()
    {
        return $this->belongsTo(Horario_Medico::class, 'horario_medico_id');
    }

    public function fichas_sintomatica()
    {
        return $this->belongsTo(FichaSintomatica::class, 'ficha_sintomatica_id');
    }

    public function status_cita()
    {
        return $this->belongsTo(Status_Cita::class, 'status_id');
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
