<?php

namespace App\Jobs;

use App\Imports\PatientsImport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ImportPatientsJob implements ShouldQueue
{
    use Queueable;

    public int $timeout = 600;

    public int $tries = 1;

    public function __construct(public string $filePath) {}

    public function handle(): void
    {
        $fullPath = Storage::disk('local')->path($this->filePath);

        Log::info("ImportPatientsJob: intentando leer archivo: {$fullPath}");

        if (! file_exists($fullPath)) {
            Log::error("ImportPatientsJob: archivo no encontrado en: {$fullPath}");
            throw new \RuntimeException("El archivo de importación no existe: {$fullPath}");
        }

        try {
            Excel::import(new PatientsImport, $fullPath);
            Log::info("ImportPatientsJob: importación completada para {$fullPath}");
        } catch (\Throwable $e) {
            Log::error('ImportPatientsJob falló: '.$e->getMessage(), [
                'file' => $fullPath,
                'trace' => $e->getTraceAsString(),
            ]);
            throw $e;
        }
    }
}
