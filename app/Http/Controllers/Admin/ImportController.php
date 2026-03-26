<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\ImportPatientsJob;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function show()
    {
        return view('admin.patients.import');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx,xls|max:10240',
        ]);

        $path = $request->file('file')->store('imports');

        ImportPatientsJob::dispatch($path);

        return back()->with('success', '✅ Archivo recibido. Los pacientes se importarán en segundo plano. Revisa la lista de pacientes en unos momentos.');
    }
}
