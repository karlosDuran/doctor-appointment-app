<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Insurance;

class InsuranceController extends Controller
{
    public function index()
    {
        $insurances = Insurance::all();
        return view('insurances.index', compact('insurances'));
    }

    public function create()
    {
        return view('insurances.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_empresa' => 'required|string|max:255',
            'telefono_contacto' => 'required|string|max:255',
            'notas_adicionales' => 'nullable|string',
        ]);

        Insurance::create($request->all());

        return redirect()->route('admin.admin.insurances.index')
                         ->with('success', 'Aseguradora guardada con éxito.');
    }
}
