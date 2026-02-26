{{-- Componente: tabs --}}
{{-- Contenedor principal del sistema de pestañas con Alpine.js --}}
{{-- Uso: --}}
{{-- <x-tabs active="nombre-tab-inicial"> --}}
    {{-- <x-slot name="header"> ...tabs-link aquí... </x-slot> --}}
    {{-- ...tab-content aquí... --}}
    {{-- </x-tabs> --}}

@props(['active' => 'default'])
<div x-data="{ tab: '{{ $active }}' }">
    {{-- Encabezado con los links de las pestañas --}}
    @isset($header)
        <div class="border-b border-gray-200">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500">
                {{ $header }}
            </ul>
        </div>
    @endisset

    {{-- Contenido de las pestañas --}}
    <div class="p-4 mt-4">
        {{ $slot }}
    </div>
</div>