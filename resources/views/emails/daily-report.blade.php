<h1>Reporte de Citas para Hoy ({{ now()->format('d/m/Y') }})</h1>

@if($appointments->isEmpty())
    <p>No hay citas programadas para hoy.</p>
@else
    <table border="1" cellpadding="5" cellspacing="0">
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
                    <td>{{ $appointment->patient->user->name }}</td>
                    <td>{{ $appointment->doctor->user->name }}</td>
                    <td>{{ $appointment->start_time }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
