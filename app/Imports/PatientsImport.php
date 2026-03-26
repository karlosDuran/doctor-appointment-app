<?php

namespace App\Imports;

use App\Models\BloodType;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Spatie\Permission\Models\Role;

class PatientsImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * Map each CSV row to a User + Patient record.
     */
    public function model(array $row): ?Patient
    {
        // Skip duplicate emails
        if (User::where('email', $row['email'])->exists()) {
            return null;
        }

        $user = User::create([
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => Hash::make($row['password'] ?? 'password'),
            'id_number' => $row['id_number'],
            'phone' => $row['phone'],
            'address' => $row['address'] ?? '',
        ]);

        // Assign patient role if role exists
        $patientRole = Role::where('name', 'patient')->first();
        if ($patientRole) {
            $user->assignRole($patientRole);
        }

        $bloodType = BloodType::where('name', $row['blood_type'] ?? '')->first();

        return new Patient([
            'user_id' => $user->id,
            'blood_type_id' => $bloodType?->id,
            'allergies' => $row['allergies'] ?? null,
            'emergency_contact_name' => $row['emergency_contact_name'] ?? null,
            'emergency_contact_phone' => $row['emergency_contact_phone'] ?? null,
            'emergency_contact_relationship' => $row['emergency_contact_relationship'] ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'id_number' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
        ];
    }
}
