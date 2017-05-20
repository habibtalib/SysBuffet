<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cviebrock\EloquentSluggable\Sluggable;

class Usuario extends Authenticatable
{
    use Sluggable;
    use softDeletes;

    /**
    * Return the sluggable configuration array for this model.
    *
    * @return array
    */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'usuario'
            ]
        ];
    }

    protected $fillable = [
        'usuario', 'baja', 'password', 'nombre','apellido', 'documento', 'email', 'telefono', 'departamento', 'ubicacion_id', 'rol_id', 'habilitado', 'password'
    ];

    protected $hidden = [
         'remember_token', 'created_at', 'updated_at', 'password'
    ];

    protected $table = 'usuarios';
    protected $dates = ['deleted_at'];

    public function rol()
    {
      return $this->belongsTo('App\Models\Rol');
    }

    public function ubicacion()
    {
      return $this->belongsTo('App\Models\Ubicacion');
    }

    public function pedidosRealizados()
    {
        return $this->hasMany('App\Models\Pedido');
    }
}
