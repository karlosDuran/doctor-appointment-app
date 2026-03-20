<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Comprobante de Cita Médica</title>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        .info { margin-bottom: 20px; }
        .footer { margin-top: 50px; text-align: center; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Comprobante de Cita</h1>
    </div>

    <div class="info">
        <p><strong>Paciente:</strong> {{ $appointment->patient->user->name }}</p>
        <p><strong>Doctor:</strong> {{ $appointment->doctor->user->name }}</p>
        <p><strong>Fecha:</strong> {{ $appointment->date->format('d/m/Y') }}</p>
        <p><strong>Hora:</strong> {{ $appointment->start_time }}</p>
        <p><strong>Motivo:</strong> {{ $appointment->reason ?? 'No especificado' }}</p>
    </div>

    <div class="footer">
        <p>Gracias por confiar en nosotros.</p>
    </div>
</body>
</html>
