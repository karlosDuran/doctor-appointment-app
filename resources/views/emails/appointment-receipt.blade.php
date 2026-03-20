<p>Hola {{ $appointment->patient->user->name }},</p>
<p>Se ha programado tu cita médica exitosamente.</p>
<p>Adjunto encontrarás el comprobante de tu cita para el día {{ $appointment->date->format('d/m/Y') }} a las {{ $appointment->start_time }}.</p>
<p>Saludos.</p>
