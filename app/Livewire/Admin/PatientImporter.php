<?php

namespace App\Livewire\Admin;

use App\Jobs\ImportPatientsJob;
use Livewire\Component;
use Livewire\WithFileUploads;

class PatientImporter extends Component
{
    use WithFileUploads;

    public $file;

    public ?string $message = null;

    public bool $success = false;

    public function upload(): void
    {
        $this->validate([
            'file' => 'required|file|mimes:csv,xlsx,xls|max:10240',
        ]);

        $path = $this->file->store('imports');

        ImportPatientsJob::dispatch($path);

        $this->file = null;
        $this->success = true;
        $this->message = '✅ Archivo recibido. Los pacientes se importarán en segundo plano.';
    }

    public function render()
    {
        return view('livewire.admin.patient-importer')
            ->layout('layouts.app');
    }
}
