<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $table = 'hoteles';

    protected $fillable = [
        'nombre',
        'direccion',
        'ciudad',
        'pais',
        'telefono',
        'email',
        'clasificacion',
        'servicios',
        'descripcion',
        'fecha_apertura',
        'imagenes',
        'pagina_web',
        'activo',
    ];

    public function habitaciones()
    {
        return $this->hasMany(Habitacion::class);
    }
}
