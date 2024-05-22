<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactoEmergencia extends Model
{
    use HasFactory;

    protected $table = 'contacto_emergencia';

    protected $fillable = [
        'reserva_id',
        'nombres',
        'telefono',
    ];

    public function reserva()
    {
        return $this->belongsTo(Reservas::class);
    }
}
