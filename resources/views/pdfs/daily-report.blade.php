<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte Diario de Citas</title>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        .footer { margin-top: 50px; text-align: center; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte Diario de Citas</h1>
        <p>Fecha: {{ now()->format('d/m/Y') }}</p>
    </div>

    @if($appointments->isEmpty())
        <p>No hay citas programadas para hoy.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Doctor</th>
                    <th>Hora</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->patient->user->name ?? 'N/A' }}</td>
                        <td>{{ $appointment->doctor->user->name ?? 'N/A' }}</td>
                        <td>{{ $appointment->start_time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="footer">
        <p>Generado automáticamente por el Sistema de Clínica de Karlos Durán.</p>
    </div>
</body>
</html>
