<?php

namespace App\Jobs;

use App\Imports\PatientsImport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Maatwebsite\Excel\Facades\Excel;

class ImportPatientsJob implements ShouldQueue
{
    use Queueable;

    public int $timeout = 600;

    public function __construct(public string $filePath) {}

    public function handle(): void
    {
        Excel::import(new PatientsImport, storage_path('app/'.$this->filePath));
    }
}
