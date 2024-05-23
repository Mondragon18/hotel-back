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
        'pasajero_id',
        'fecha_entrada',
        'fecha_salida',
        'monto_total',
        'estado',
    ];

    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class);
    }

    public function pasajero()
    {
        return $this->belongsTo(Pasajero::class);
    }

    public function contactoEmergencia()
    {
        return $this->hasOne(ContactoEmergencia::class);
    }

}
