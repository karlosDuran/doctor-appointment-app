<x-admin-layout
    title="Importar Pacientes | MediCitas"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard'),
        ],
        [
            'name' => 'Pacientes',
            'href' => route('admin.admin.patients.index'),
        ],
        [
            'name' => 'Importar',
        ],
    ]">

    <div class="max-w-3xl mx-auto py-8 px-4">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
            {{-- Header --}}
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Importar Pacientes</h1>
                <p class="text-sm text-gray-500 mt-1">
                    Sube un archivo <strong>Excel (.xlsx)</strong> o <strong>CSV (.csv)</strong> con los pacientes de la clínica. El procesamiento se hará en segundo plano.
                </p>
            </div>

            {{-- Referencia de columnas --}}
            <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-4 mb-6 text-sm text-indigo-800">
                <p class="font-semibold mb-1">📋 Columnas requeridas en el archivo:</p>
                <code class="text-xs break-all">name, email, id_number, phone, address, password, blood_type, allergies, emergency_contact_name, emergency_contact_phone, emergency_contact_relationship</code>
                <p class="text-xs mt-2 text-indigo-600">Si no se incluye <em>password</em>, se asignará "password" como contraseña por defecto. Las filas con emails duplicados se omiten automáticamente.</p>
            </div>

            @livewire('admin.patient-importer')
        </div>
    </div>

</x-admin-layout>
