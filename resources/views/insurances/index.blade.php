<x-admin-layout
    title="Aseguradoras"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard'),
        ],
        [
            'name' => 'Aseguradoras',
        ],
    ]">

    <x-slot name="action">
        <a href="{{ route('admin.admin.insurances.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-2 inline-block">
            Nueva Aseguradora
        </a>
    </x-slot>

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">NOMBRE DE LA EMPRESA</th>
                        <th scope="col" class="px-6 py-3">TELÉFONO DE CONTACTO</th>
                        <th scope="col" class="px-6 py-3">FECHA DE REGISTRO</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($insurances as $insurance)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $insurance->id }}
                            </td>
                            <td class="px-6 py-4">{{ $insurance->nombre_empresa }}</td>
                            <td class="px-6 py-4">{{ $insurance->telefono_contacto }}</td>
                            <td class="px-6 py-4">{{ $insurance->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td colspan="4" class="px-6 py-4 text-center">No hay aseguradoras registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
