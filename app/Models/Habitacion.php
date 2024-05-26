<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    use HasFactory;

    protected $table = 'habitacion';

    protected $fillable = [
        'hotel_id',
        'tipo',
        'numero_persona',
        'costo_base',
        'impuestos',
        'descripcion',
        'activo',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function reservas()
    {
        return $this->hasMany(Reservas::class);
    }

    protected $appends = ['total'];

    public function getTotalAttribute()
    { 
        return ($this->costo_base + $this->impuestos);
    }
}
