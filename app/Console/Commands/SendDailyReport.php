<?php

namespace App\Console\Commands;

use App\Mail\DailyAppointmentsReport;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDailyReport extends Command
{
    protected $signature = 'app:send-daily-report';
    protected $description = 'Send a daily report of scheduled appointments to administrators';

    public function handle()
    {
        $today = now()->toDateString();
        $appointments = Appointment::with(['patient.user', 'doctor.user'])
            ->whereDate('date', $today)
            ->where('status', Appointment::STATUS_SCHEDULED)
            ->get();

        // Enviar al administrador
        $adminEmail = config('mail.admin_email') ?? 'karlos.Duran@tecdesoftware.edu.mx';

        Mail::to($adminEmail)->send(new DailyAppointmentsReport($appointments));

        $this->info('Reporte diario enviado a ' . $adminEmail);
    }
}
