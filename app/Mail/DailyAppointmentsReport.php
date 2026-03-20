<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class DailyAppointmentsReport extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Collection $appointments)
    {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reporte Diario de Citas - ' . now()->format('d/m/Y'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.daily-report',
        );
    }

    public function attachments(): array
    {
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdfs.daily-report', ['appointments' => $this->appointments]);

        return [
            \Illuminate\Mail\Mailables\Attachment::fromData(fn () => $pdf->output(), 'reporte-diario-citas.pdf')
                ->withMime('application/pdf'),
        ];
    }
}

