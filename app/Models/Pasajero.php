<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasajero extends Model
{
    use HasFactory;
    protected $table = 'pasajeros';

    protected $fillable = [
        'user_id',
        'reserva_id',
        'fecha_nacimiento',
        'genero',
        'tipo_documento',
        'numero_documento',
        'telefono',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reserva()
    {
        return $this->belongsTo(Reservas::class, 'reserva_id');
    }
}
