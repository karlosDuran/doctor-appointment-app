{{-- Componente: tab-content --}}
{{-- Muestra u oculta el contenido según la pestaña activa --}}
{{-- Uso: <x-tab-content tab="nombre-tab"> ...contenido... </x-tab-content> --}}

@props(['tab'])
<div x-show="tab === '{{ $tab }}'" x-cloak>
    {{ $slot }}
</div>