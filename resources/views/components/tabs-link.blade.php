{{-- Componente: tabs-link --}}
{{-- Link individual de pestaña con soporte para indicador de error --}}
{{-- Uso: <x-tabs-link tab="nombre-tab" :error="$hasError"> Texto </x-tabs-link> --}}

@props(['tab', 'error' => false])
<li class="me-2">
    <a href="#" x-on:click.prevent="tab = '{{ $tab }}'" :class="{
            'text-red-600 border-red-600': {{ $error ? 'true' : 'false' }} && tab!='{{ $tab }}',
            'text-blue-600 border-blue-600 active': tab === '{{ $tab }}' && !{{ $error ? 'true' : 'false' }},
            'text-red-600 border-red-600 active': tab==='{{ $tab }}' && {{ $error ? 'true' : 'false' }},
            'text-gray-600 border-transparent hover:text-blue-600 hover:border-blue-600': tab !== '{{ $tab }}' && !{{ $error ? 'true' : 'false' }}
        }"
        class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group transition-colors duration-200"
        :aria-current="tab === '{{ $tab }}' ? 'page' : undefined">
        {{ $slot }}
        @if($error)
            <i class="fa-solid fa-circle-exclamation ms-2 animate-pulse"></i>
        @endif
    </a>
</li>