<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FichaSintomatica extends Model
{
    use SoftDeletes;
    protected $table = 'fichas_sintomaticas';
    protected $fillable = ['persona_id', 'fecha', 'hora','descripcion', 'activo'];

    public function personas()
    {
        return $this->belongsTo(Persona::class, 'persona_id');
    }
}
