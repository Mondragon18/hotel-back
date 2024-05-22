<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiciosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

      $now = Carbon::now();

      DB::table('servicios')->insert([
        ['nombre' => 'Alojamiento', 'descripcion' => 'Habitaciones de diferentes categorías', 'created_at' => $now, 'updated_at' => $now],
        ['nombre' => 'Recepción 24 horas', 'descripcion' => 'Atención al cliente en cualquier momento del día', 'created_at' => $now, 'updated_at' => $now],
        ['nombre' => 'Servicio de Limpieza', 'descripcion' => 'Limpieza diaria de las habitaciones', 'created_at' => $now, 'updated_at' => $now],
        ['nombre' => 'Desayuno', 'descripcion' => 'Incluido o disponible como un servicio adicional.', 'created_at' => $now, 'updated_at' => $now],
        ['nombre' => 'Restaurantes', 'descripcion' => 'De diferentes tipos de cocina.', 'created_at' => $now, 'updated_at' => $now],
        ['nombre' => 'Bares', 'descripcion' => 'Dentro del hotel, en la azotea o junto a la piscina.', 'created_at' => $now, 'updated_at' => $now],
        ['nombre' => 'Servicio a la Habitación', 'descripcion' => 'Comida y bebidas entregadas directamente a la habitación.', 'created_at' => $now, 'updated_at' => $now],
        ['nombre' => 'Piscinas', 'descripcion' => 'Interiores y/o exteriores.', 'created_at' => $now, 'updated_at' => $now],
        ['nombre' => 'Gimnasio', 'descripcion' => 'Equipado con máquinas de ejercicio.', 'created_at' => $now, 'updated_at' => $now],
        ['nombre' => 'Spa', 'descripcion' => 'Servicios de masajes, tratamientos de belleza y relajación.', 'created_at' => $now, 'updated_at' => $now],
        ['nombre' => 'Actividades Recreativas', 'descripcion' => 'Yoga, pilates, clases de baile', 'created_at' => $now, 'updated_at' => $now],
        ['nombre' => 'Entretenimiento Nocturno', 'descripcion' => 'Espectáculos en vivo, música', 'created_at' => $now, 'updated_at' => $now],
        ['nombre' => 'Salas de Conferencias y Reuniones', 'descripcion' => 'Equipadas con tecnología audiovisual.', 'created_at' => $now, 'updated_at' => $now],
        ['nombre' => 'Centro de Negocios', 'descripcion' => 'Con acceso a computadoras, impresoras', 'created_at' => $now, 'updated_at' => $now],
        ['nombre' => 'Wi-Fi', 'descripcion' => 'Gratuito o de pago, en todo el hotel o en áreas comunes.', 'created_at' => $now, 'updated_at' => $now],
        ['nombre' => 'Transporte', 'descripcion' => 'Servicio de traslado al aeropuerto, alquiler de coches, taxis.', 'created_at' => $now, 'updated_at' => $now],
        ['nombre' => 'Estacionamiento', 'descripcion' => 'Gratuito o de pago, valet parking.', 'created_at' => $now, 'updated_at' => $now],
        ['nombre' => 'Consigna de Equipaje', 'descripcion' => 'Para guardar el equipaje antes del check-in o después del check-out.', 'created_at' => $now, 'updated_at' => $now],
        ['nombre' => 'Concierge', 'descripcion' => 'Ayuda con reservas de restaurantes, tours, entradas para eventos, etc.', 'created_at' => $now, 'updated_at' => $now],
        ['nombre' => 'Lavandería y Tintorería', 'descripcion' => 'Lavado y planchado de ropa.', 'created_at' => $now, 'updated_at' => $now],
        ['nombre' => 'Cajero Automático', 'descripcion' => 'En el hotel o cercano.', 'created_at' => $now, 'updated_at' => $now],
        ['nombre' => 'Tienda de Regalos', 'descripcion' => 'Venta de souvenirs y artículos de primera necesidad.', 'created_at' => $now, 'updated_at' => $now],
        ['nombre' => 'Servicio de Canguro', 'descripcion' => 'Cuidado de niños.', 'created_at' => $now, 'updated_at' => $now],
        ['nombre' => 'Habitaciones Adaptadas', 'descripcion' => 'Para personas con movilidad reducida.', 'created_at' => $now, 'updated_at' => $now],
        ['nombre' => 'Servicio de Mascotas', 'descripcion' => 'Habitaciones pet-friendly, servicios de cuidado y paseo de mascotas.', 'created_at' => $now, 'updated_at' => $now],
        ['nombre' => 'Actividades para Niños', 'descripcion' => 'Club infantil, áreas de juegos, actividades supervisadas.', 'created_at' => $now, 'updated_at' => $now],
      ]);
    }
}
