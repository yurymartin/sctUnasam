<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'empleado_id', 'tipo_usuario_id', 'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeActivo($query)
    {
        return $query->where('users.activo', '1');
    }

    public function tipo_usuarios()
    {
        return $this->belongsTo(Tipo_Usuario::class, 'tipo_usuario_id');
    }

    public function empleados()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    public function scopeBuscar($query, $buscar)
    {
        if ($buscar) {
            $query = $query->orWhere('name', 'LIKE', "%$buscar%");
        }
        if ($buscar) {
            $query = $query->orWhere('email', 'LIKE', "%$buscar%");
        }
        return $query;
    }
}
