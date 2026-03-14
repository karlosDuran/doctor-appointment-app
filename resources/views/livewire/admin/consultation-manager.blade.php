<div>
    {{-- Header: Patient info + action buttons --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">
                {{ $appointment['patient']['user']['name'] ?? 'Paciente' }}
            </h2>
            <p class="text-sm text-gray-500">
                DNI: {{ $appointment['patient']['user']['id_number'] ?? 'N/A' }}
            </p>
        </div>
        <div class="flex gap-2 mt-4 md:mt-0">
            {{-- Ver Historia button --}}
            <button wire:click="$set('showHistoryModal', true)" type="button"
                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <i class="fa-solid fa-eye mr-2"></i>
                Ver Historia
            </button>

            {{-- Consultas Anteriores button --}}
            <button wire:click="loadPreviousConsultations" type="button"
                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <i class="fa-solid fa-clock-rotate-left mr-2"></i>
                Consultas Anteriores
            </button>
        </div>
    </div>

    {{-- Tabs --}}
    <div class="border-b border-gray-200 mb-6">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500">
            <li class="me-2">
                <button wire:click="$set('activeTab', 'consulta')" type="button"
                    class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group transition-colors duration-200
                        {{ $activeTab === 'consulta' ? 'text-blue-600 border-blue-600' : 'border-transparent hover:text-blue-600 hover:border-blue-600' }}">
                    <i class="fa-solid fa-stethoscope me-2"></i>
                    Consulta
                </button>
            </li>
            <li class="me-2">
                <button wire:click="$set('activeTab', 'receta')" type="button"
                    class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group transition-colors duration-200
                        {{ $activeTab === 'receta' ? 'text-blue-600 border-blue-600' : 'border-transparent hover:text-blue-600 hover:border-blue-600' }}">
                    <i class="fa-solid fa-prescription me-2"></i>
                    Receta
                </button>
            </li>
        </ul>
    </div>

    {{-- Tab Content: Consulta --}}
    @if ($activeTab === 'consulta')
        <div class="space-y-6">
            {{-- Diagnóstico --}}
            <div>
                <label for="diagnosis" class="block text-sm font-medium text-gray-700 mb-1">Diagnóstico</label>
                <textarea wire:model="diagnosis" id="diagnosis" rows="4"
                    placeholder="Describa el diagnóstico del paciente aquí..."
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm placeholder-gray-400 @error('diagnosis') border-red-500 @enderror"></textarea>
                @error('diagnosis')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- Tratamiento --}}
            <div>
                <label for="treatment" class="block text-sm font-medium text-gray-700 mb-1">Tratamiento</label>
                <textarea wire:model="treatment" id="treatment" rows="4"
                    placeholder="Describa el tratamiento recomendado aquí..."
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm placeholder-gray-400 @error('treatment') border-red-500 @enderror"></textarea>
                @error('treatment')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- Notas --}}
            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Notas</label>
                <textarea wire:model="notes" id="notes" rows="4"
                    placeholder="Agregue notas adicionales sobre la consulta..."
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm placeholder-gray-400"></textarea>
            </div>
        </div>
    @endif

    {{-- Tab Content: Receta --}}
    @if ($activeTab === 'receta')
        <div>
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-4 py-3">Medicamento</th>
                        <th class="px-4 py-3 w-40">Dosis</th>
                        <th class="px-4 py-3">Frecuencia / Duración</th>
                        <th class="px-4 py-3 w-16"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($medications as $index => $medication)
                        <tr class="bg-white border-b">
                            <td class="px-4 py-3">
                                <input type="text" wire:model="medications.{{ $index }}.name"
                                    placeholder="Ej. Amoxicilina 500mg"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm text-gray-900 placeholder-gray-400">
                            </td>
                            <td class="px-4 py-3">
                                <input type="text" wire:model="medications.{{ $index }}.dose" placeholder="1 cada 8 horas"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm text-gray-900 placeholder-gray-400">
                            </td>
                            <td class="px-4 py-3">
                                <input type="text" wire:model="medications.{{ $index }}.frequency"
                                    placeholder="Ej. cada 8 horas por 7 días"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm text-gray-900 placeholder-gray-400">
                            </td>
                            <td class="px-4 py-3">
                                @if (count($medications) > 1)
                                    <button wire:click="removeMedication({{ $index }})" type="button"
                                        class="inline-flex items-center px-2 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 transition">
                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                <button wire:click="addMedication" type="button"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Añadir Medicamento
                </button>
            </div>
        </div>
    @endif

    {{-- Save button --}}
    <div class="flex justify-end mt-6">
        <button wire:click="saveConsultation" type="button"
            class="inline-flex items-center px-6 py-2.5 bg-indigo-600 text-white font-medium text-sm rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
            <i class="fa-solid fa-floppy-disk mr-2"></i>
            Guardar Consulta
        </button>
    </div>

    {{-- MODAL: Historia Médica del Paciente --}}
    @if ($showHistoryModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                {{-- Backdrop --}}
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                    wire:click="$set('showHistoryModal', false)"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-bold text-gray-900">Historia médica del paciente</h3>
                            <button wire:click="$set('showHistoryModal', false)" type="button"
                                class="text-gray-400 hover:text-gray-600">
                                <i class="fa-solid fa-xmark text-lg"></i>
                            </button>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                            <div>
                                <p class="text-xs text-gray-500 font-semibold">Tipo de sangre:</p>
                                <p class="text-sm text-gray-900">
                                    {{ $patientHistory['blood_type'] }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-semibold">Alergias:</p>
                                <p class="text-sm text-gray-900">
                                    {{ $patientHistory['allergies'] }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-semibold">Enfermedades crónicas:</p>
                                <p class="text-sm text-gray-900">
                                    {{ $patientHistory['chronic_conditions'] }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-semibold">Antecedentes quirúrgicos:</p>
                                <p class="text-sm text-gray-900">
                                    {{ $patientHistory['surgical_history'] }}
                                </p>
                            </div>
                        </div>

                        <div class="flex justify-center mt-4">
                            <a href="{{ route('admin.admin.patients.edit', $patientHistory['patient_id']) }}"
                                class="text-indigo-600 hover:text-indigo-800 font-medium text-sm">
                                Ver / Editar Historia Médica
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- MODAL: Consultas Anteriores --}}
    @if ($showPreviousConsultationsModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                {{-- Backdrop --}}
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                    wire:click="$set('showPreviousConsultationsModal', false)"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full max-h-[80vh]">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-bold text-gray-900">Consultas Anteriores</h3>
                            <button wire:click="$set('showPreviousConsultationsModal', false)" type="button"
                                class="text-gray-400 hover:text-gray-600">
                                <i class="fa-solid fa-xmark text-lg"></i>
                            </button>
                        </div>

                        <div class="space-y-4 overflow-y-auto max-h-[60vh] pr-2">
                            @forelse ($previousConsultations as $prevAppt)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <p class="text-sm font-semibold text-indigo-600">
                                                <i class="fa-solid fa-calendar mr-1"></i>
                                                {{ \Carbon\Carbon::parse($prevAppt['date'])->format('d/m/Y') }} a las
                                                {{ \Carbon\Carbon::parse($prevAppt['start_time'])->format('H:i') }}
                                            </p>
                                            <p class="text-xs text-gray-500 mt-1">
                                                Atendido por: Dr(a). {{ $prevAppt['doctor']['user']['name'] ?? 'N/A' }}
                                            </p>
                                        </div>
                                        <a href="{{ route('admin.admin.appointments.consult', $prevAppt['id']) }}"
                                            class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md text-xs font-medium text-gray-700 bg-white hover:bg-gray-50">
                                            Consultar Detalle
                                        </a>
                                    </div>

                                    <div class="bg-gray-50 rounded-md p-3 text-sm">
                                        @if (!empty($prevAppt['consultation']))
                                            <p><span class="font-semibold text-gray-700">Diagnóstico:</span>
                                                {{ $prevAppt['consultation']['diagnosis'] }}</p>
                                            <p class="mt-1"><span class="font-semibold text-gray-700">Tratamiento:</span>
                                                {{ $prevAppt['consultation']['treatment'] }}</p>
                                            @if (!empty($prevAppt['consultation']['notes']))
                                                <p class="mt-1"><span class="font-semibold text-gray-700">Notas:</span>
                                                    {{ $prevAppt['consultation']['notes'] }}</p>
                                            @endif
                                        @else
                                            <p class="text-gray-400 italic">Sin datos de consulta registrados.</p>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8 text-gray-400">
                                    <i class="fa-solid fa-folder-open text-3xl mb-2"></i>
                                    <p>No hay consultas anteriores registradas para este paciente.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>