<div class="max-w-3xl mx-auto py-8 px-4">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Importar Pacientes</h1>
            <p class="text-sm text-gray-500 mt-1">
                Sube un archivo <strong>Excel (.xlsx)</strong> o <strong>CSV (.csv)</strong> con los pacientes de la clínica. El procesamiento se hará en segundo plano.
            </p>
        </div>

        {{-- Columns reference --}}
        <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-4 mb-6 text-sm text-indigo-800">
            <p class="font-semibold mb-1">📋 Columnas requeridas en el archivo:</p>
            <code class="text-xs break-all">name, email, id_number, phone, address, password, blood_type, allergies, emergency_contact_name, emergency_contact_phone, emergency_contact_relationship</code>
            <p class="text-xs mt-2 text-indigo-600">Si no se incluye <em>password</em>, se asignará "password" como contraseña por defecto. Las filas con emails duplicados se omiten automáticamente.</p>
        </div>

        {{-- Status message --}}
        @if($message)
            <div class="mb-4 p-4 rounded-lg {{ $success ? 'bg-green-50 border border-green-200 text-green-800' : 'bg-red-50 border border-red-200 text-red-800' }}">
                {{ $message }}
            </div>
        @endif

        {{-- Upload form --}}
        <form wire:submit="upload" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="patientFile" class="block text-sm font-medium text-gray-700 mb-1">Archivo de pacientes</label>
                <input type="file" wire:model="file" id="patientFile" accept=".csv,.xlsx,.xls"
                    class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer focus:ring-indigo-500 focus:border-indigo-500 p-2">
                @error('file')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                wire:loading.attr="disabled" wire:target="upload"
                class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 transition disabled:opacity-70 disabled:cursor-wait">
                <span wire:loading.remove wire:target="upload">
                    <i class="fa-solid fa-cloud-arrow-up mr-2"></i> Importar en segundo plano
                </span>
                <span wire:loading wire:target="upload">
                    <i class="fa-solid fa-spinner fa-spin mr-2"></i> Subiendo...
                </span>
            </button>
        </form>
    </div>
</div>
