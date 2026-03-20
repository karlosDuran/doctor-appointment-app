<?php

namespace App\Observers;

use App\Mail\AppointmentReceipt;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;

class AppointmentObserver
{
    /**
     * Handle the Appointment "created" event.
     */
    public function created(Appointment $appointment): void
    {
        // Enviar el correo al paciente y al doctor
        $patientEmail = $appointment->patient->user->email ?? null;
        $doctorEmail = $appointment->doctor->user->email ?? null;

        if ($patientEmail) {
            Mail::to($patientEmail)->send(new AppointmentReceipt($appointment));
        }

        if ($doctorEmail) {
            Mail::to($doctorEmail)->send(new AppointmentReceipt($appointment));
        }
    }
}
