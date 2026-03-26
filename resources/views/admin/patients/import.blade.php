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

            {{-- Título --}}
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Importar Pacientes</h1>
                <p class="text-sm text-gray-500 mt-1">
                    Sube un archivo <strong>Excel (.xlsx)</strong> o <strong>CSV (.csv)</strong>.
                    El procesamiento ocurre en segundo plano.
                </p>
            </div>

            {{-- Referencia de columnas --}}
            <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-4 mb-6 text-sm text-indigo-800">
                <p class="font-semibold mb-1">📋 Columnas aceptadas en el CSV:</p>
                <code class="text-xs break-all">nombre_completo, correo, telefono, tipo_sangre, alergias</code>
                <p class="text-xs mt-2 text-indigo-600">
                    Las filas con correos duplicados se omiten automáticamente.
                </p>
            </div>

            {{-- Mensaje de éxito --}}
            @if(session('success'))
                <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Mensaje de error --}}
            @if($errors->has('file'))
                <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200 text-red-800">
                    {{ $errors->first('file') }}
                </div>
            @endif

            {{-- Formulario estándar HTML (sin Livewire) --}}
            <form action="{{ route('admin.imports.store') }}" method="POST" enctype="multipart/form-data"
                  id="importForm" onsubmit="startLoading()">
                @csrf

                <div class="mb-4">
                    <label for="patientFile" class="block text-sm font-medium text-gray-700 mb-1">
                        Archivo de pacientes
                    </label>
                    <input type="file" name="file" id="patientFile" accept=".csv,.xlsx,.xls"
                        class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer p-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Barra de progreso (oculta hasta que se envía) --}}
                <div id="progressBar" class="hidden mb-4">
                    <p class="text-sm text-indigo-700 mb-1 font-medium">⏳ Subiendo archivo, por favor espera...</p>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-indigo-600 h-2.5 rounded-full animate-pulse" style="width: 100%"></div>
                    </div>
                </div>

                <button type="submit" id="submitBtn"
                    class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 transition disabled:opacity-70 disabled:cursor-wait">
                    <i class="fa-solid fa-cloud-arrow-up mr-2"></i> Importar en segundo plano
                </button>
            </form>
        </div>
    </div>

    <script>
        function startLoading() {
            document.getElementById('progressBar').classList.remove('hidden');
            document.getElementById('submitBtn').disabled = true;
            document.getElementById('submitBtn').innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i> Subiendo...';
        }
    </script>

</x-admin-layout>
