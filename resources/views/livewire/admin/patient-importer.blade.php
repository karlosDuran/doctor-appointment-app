<div>
    {{-- Mensaje de estado --}}
    @if($message)
        <div class="mb-4 p-4 rounded-lg {{ $success ? 'bg-green-50 border border-green-200 text-green-800' : 'bg-red-50 border border-red-200 text-red-800' }}">
            {{ $message }}
        </div>
    @endif

    {{-- Formulario de carga --}}
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
