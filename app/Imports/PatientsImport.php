<?php

namespace App\Imports;

use App\Models\BloodType;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Spatie\Permission\Models\Role;

class PatientsImport implements ToModel, WithHeadingRow
{
    /**
     * Mapea cada fila del CSV/Excel a un User + Patient.
     * Columnas aceptadas (en español):
     *   nombre_completo, correo, telefono, fecha_nacimiento, tipo_sangre, alergias
     */
    public function model(array $row): ?Patient
    {
        $email = $row['correo'] ?? null;

        if (! $email || User::where('email', $email)->exists()) {
            return null;
        }

        $user = User::create([
            'name' => $row['nombre_completo'] ?? 'Sin nombre',
            'email' => $email,
            'password' => Hash::make($row['password'] ?? 'password'),
            'id_number' => $row['id_number'] ?? Str::random(8),
            'phone' => $row['telefono'] ?? '0000000000',
            'address' => $row['direccion'] ?? 'Sin dirección',
        ]);

        $patientRole = Role::where('name', 'patient')->first();
        if ($patientRole) {
            $user->assignRole($patientRole);
        }

        $bloodType = BloodType::where('name', $row['tipo_sangre'] ?? '')->first();

        // Crear el Patient directamente con user_id (no está en $fillable del modelo)
        $patient = new Patient;
        $patient->user_id = $user->id;
        $patient->blood_type_id = $bloodType?->id;
        $patient->allergies = $row['alergias'] ?? null;
        $patient->save();

        return null; // Ya guardamos manualmente, no dejar que Maatwebsite lo intente de nuevo
    }
}
