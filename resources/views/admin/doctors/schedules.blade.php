<x-admin-layout title="Horarios | MediCitas" :breadcrumbs="[
        ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
        ['name' => 'Doctores', 'href' => route('admin.admin.doctors.index')],
        ['name' => 'Horarios'],
    ]">

    @livewire('admin.schedule-manager', ['doctorId' => $doctor->id])
</x-admin-layout>