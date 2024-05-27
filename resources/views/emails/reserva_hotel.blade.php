<!DOCTYPE html>
<html>
<head>
    <title>Detalle de tu Reserva de Hotel</title>
</head>
<body>
    <h1>Detalle de tu Reserva de Hotel</h1>
    <p><strong>Estado de la Reserva:</strong> {{ $reserva['estado'] ?? 'N/A' }}</p>
    <p><strong>Fecha de Entrada:</strong> {{ $reserva['fecha_entrada'] ?? 'N/A' }}</p>
    <p><strong>Fecha de Salida:</strong> {{ $reserva['fecha_salida'] ?? 'N/A' }}</p>
    <p><strong>Habitación:</strong> {{ $reserva['habitacion']['tipo'] ?? 'N/A' }} ({{ $reserva['habitacion']['numero_persona'] ?? 'N/A' }} personas)</p>
    <p><strong>Costo Base:</strong> ${{ $reserva['costo_base'] ?? 'N/A' }}</p>
    <p><strong>Impuestos:</strong> ${{ $reserva['impuestos'] ?? 'N/A' }}</p>
    <p><strong>Total:</strong> ${{ $reserva['total'] ?? 'N/A' }}</p>
    <h2>Detalles del Hotel</h2>
    <p><strong>Nombre:</strong> {{ $reserva['hotel']['nombre'] ?? 'N/A' }}</p>
    <p><strong>Dirección:</strong> {{ $reserva['hotel']['direccion'] ?? 'N/A' }}</p>
    <p><strong>Ciudad:</strong> {{ $reserva['hotel']['ciudad'] ?? 'N/A' }}</p>
    <p><strong>Clasificación:</strong> {{ $reserva['hotel']['clasificacion'] ?? 'N/A' }} estrellas</p>
    <p><strong>Teléfono:</strong> {{ $reserva['hotel']['telefono'] ?? 'N/A' }}</p>
    <p><strong>Email:</strong> {{ $reserva['hotel']['email'] ?? 'N/A' }}</p>
    <p><strong>Página Web:</strong> <a href="{{ $reserva['hotel']['pagina_web'] ?? '#' }}">{{ $reserva['hotel']['pagina_web'] ?? 'N/A' }}</a></p>
    <h2>Contacto de Emergencia</h2>
    <p><strong>Nombre:</strong> {{ $reserva['contacto_emergencia']['nombres'] ?? 'N/A' }}</p>
    <p><strong>Teléfono:</strong> {{ $reserva['contacto_emergencia']['telefono'] ?? 'N/A' }}</p>
</body>
</html>