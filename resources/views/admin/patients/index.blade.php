<x-admin-layout
    title="Pacientes | MediCitas"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard'),
        ],
        [
            'name' => 'Pacientes',
        ],
    ]">

    <x-slot name="action">
        <x-wire-button blue href="{{ route('admin.imports') }}">
            <i class="fa-solid fa-file-import"></i>
            Importar
        </x-wire-button>
        <x-wire-button blue href="{{ route('admin.admin.patients.create') }}">
            <i class="fa-solid fa-plus"></i>
            Nuevo
        </x-wire-button>
    </x-slot>

    @livewire('admin.datatables.patient-table')
</x-admin-layout>
