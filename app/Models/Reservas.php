<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    use HasFactory;

    protected $table = 'reservas';

    protected $fillable = [
        'habitacion_id',
        'fecha_entrada',
        'fecha_salida',
        'monto_total',
        'estado',
        'email',
    ];

    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class);
    }

    public function contactoEmergencia()
    {
        return $this->hasMany(ContactoEmergencia::class);
    }

    public function pasajeros()
    {
        return $this->hasMany(Pasajero::class);
    }
}
