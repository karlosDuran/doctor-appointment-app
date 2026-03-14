<div>
    {{-- Search Bar --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <h2 class="text-lg font-bold text-gray-800 mb-1">Buscar disponibilidad</h2>
        <p class="text-sm text-gray-500 mb-4">Encuentra el horario perfecto para tu cita.</p>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            {{-- Fecha --}}
            <div>
                <label for="searchDate" class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                <input type="date" wire:model="searchDate" id="searchDate" min="{{ date('Y-m-d') }}"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('searchDate')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- Hora --}}
            <div>
                <label for="searchTime" class="block text-sm font-medium text-gray-700 mb-1">Hora</label>
                <select wire:model="searchTime" id="searchTime"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">Todas las horas</option>
                    @foreach ($timeOptions as $option)
                        <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Especialidad --}}
            <div>
                <label for="searchSpeciality" class="block text-sm font-medium text-gray-700 mb-1">Especialidad
                    (opcional)</label>
                <select wire:model="searchSpeciality" id="searchSpeciality"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">Todas</option>
                    @foreach ($specialities as $speciality)
                        <option value="{{ $speciality['id'] }}">{{ $speciality['name'] }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Buscar --}}
            <div>
                <button wire:click="searchAvailability" type="button"
                    class="w-full inline-flex items-center justify-center px-6 py-2.5 bg-indigo-600 text-white font-medium text-sm rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                    Buscar disponibilidad
                </button>
            </div>
        </div>
    </div>

    {{-- Results + Summary --}}
    @if ($hasSearched)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Left: Available Doctors (2/3) --}}
            <div class="lg:col-span-2 space-y-4">
                @forelse ($availableDoctors as $doctor)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center gap-4 mb-4">
                            {{-- Avatar with initials --}}
                            <div class="h-14 w-14 rounded-full bg-indigo-100 flex items-center justify-center flex-shrink-0">
                                <span class="text-indigo-600 font-bold text-lg">
                                    {{ $doctor['initials'] }}
                                </span>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">{{ $doctor['name'] }}</h3>
                                <p class="text-sm text-indigo-600">{{ $doctor['speciality'] }}</p>
                            </div>
                        </div>

                        <p class="text-sm font-semibold text-gray-600 mb-2">Horarios disponibles:</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($doctor['slots'] as $slot)
                                    <button wire:click="selectSlot({{ $doctor['id'] }}, '{{ $slot['start'] }}', '{{ $slot['end'] }}')"
                                        type="button" class="px-4 py-2 rounded-md text-sm font-medium transition
                                                                                                        {{ $selectedDoctorId == $doctor['id'] && $selectedSlotStart == $slot['start']
                                ? 'bg-indigo-600 text-white shadow-md'
                                : 'bg-indigo-100 text-indigo-700 hover:bg-indigo-200' }}">
                                        {{ $slot['start'] }}
                                    </button>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 text-center">
                        <i class="fa-solid fa-calendar-xmark text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500">No se encontraron doctores disponibles para los filtros seleccionados.</p>
                        <p class="text-gray-400 text-sm mt-1">Intenta cambiar la fecha, hora o especialidad.</p>
                    </div>
                @endforelse
            </div>

            {{-- Right: Summary Panel (1/3) --}}
            <div class="lg:col-span-1">
                @if ($selectedDoctorId)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 sticky top-24">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Resumen de la cita</h3>

                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Doctor:</span>
                                <span class="font-medium text-gray-900">{{ $selectedDoctorName }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Fecha:</span>
                                <span class="font-medium text-gray-900">{{ $selectedDate }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Horario:</span>
                                <span class="font-medium text-gray-900">{{ $selectedSlotStart }} - {{ $selectedSlotEnd }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Duración:</span>
                                <span class="font-medium text-gray-900">15 minutos</span>
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- Paciente --}}
                        <div class="mb-4">
                            <label for="patientId" class="block text-sm font-medium text-gray-700 mb-1">Paciente</label>
                            <select wire:model="patientId" id="patientId"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm text-gray-900">
                                <option value="" disabled selected class="text-gray-400">Seleccione un paciente</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient['id'] }}">{{ $patient['user']['name'] }}</option>
                                @endforeach
                            </select>
                            @error('patientId')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Motivo --}}
                        <div class="mb-6">
                            <label for="reason" class="block text-sm font-medium text-gray-700 mb-1">Motivo de la cita</label>
                            <textarea wire:model="reason" id="reason" rows="3" placeholder="Chequeo de medicamentos"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm placeholder-gray-400"></textarea>
                            @error('reason')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Confirmar --}}
                        <button wire:click="confirmAppointment" type="button"
                            class="w-full inline-flex items-center justify-center px-6 py-3 bg-indigo-600 text-white font-medium text-sm rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                            Confirmar cita
                        </button>
                    </div>
                @else
                    <div class="bg-gray-50 rounded-lg border-2 border-dashed border-gray-200 p-8 text-center">
                        <i class="fa-solid fa-hand-pointer text-3xl text-gray-300 mb-3"></i>
                        <p class="text-gray-400 text-sm">Selecciona un horario disponible para ver el resumen de la cita.</p>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>