<div>
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-800">Gestor de horarios</h2>

        <button wire:click="saveSchedules" type="button"
            class="mt-4 md:mt-0 inline-flex items-center px-6 py-2.5 bg-indigo-600 text-white font-medium text-sm rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
            Guardar horario
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase">Día/Hora</th>
                    @foreach ($days as $dayNum => $dayName)
                        <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase text-center">{{ $dayName }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($hours as $hour)
                    @php
                        $hourSlots = array_filter($timeSlots, fn($s) => $s['hour'] === $hour);
                        $hourLabel = $hour;
                    @endphp

                    {{-- Hour group header with "Todos" checkboxes --}}
                    <tr class="border-b border-gray-100 bg-gray-50">
                        <td class="px-4 py-2 font-medium text-gray-700">{{ $hourLabel }}</td>
                        @foreach ($days as $dayNum => $dayName)
                            <td class="px-4 py-2 text-center">
                                @php
                                    $allSelected = true;
                                    foreach ($hourSlots as $slot) {
                                        if (!($selectedSlots[$dayNum][$slot['start']] ?? false)) {
                                            $allSelected = false;
                                            break;
                                        }
                                    }
                                @endphp
                                <label class="inline-flex items-center gap-1 cursor-pointer text-xs text-gray-500">
                                    <input type="checkbox"
                                        wire:click="toggleAllInHour('{{ $hour }}', {{ $dayNum }})"
                                        {{ $allSelected ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    Todos
                                </label>
                            </td>
                        @endforeach
                    </tr>

                    {{-- Individual time slots --}}
                    @foreach ($hourSlots as $slot)
                        <tr class="border-b border-gray-50">
                            <td class="px-4 py-1 text-gray-500 text-xs pl-8"></td>
                            @foreach ($days as $dayNum => $dayName)
                                <td class="px-4 py-1 text-center">
                                    <label class="inline-flex items-center gap-1 cursor-pointer text-xs text-gray-600">
                                        <input type="checkbox"
                                            wire:click="toggleSlot({{ $dayNum }}, '{{ $slot['start'] }}')"
                                            {{ ($selectedSlots[$dayNum][$slot['start']] ?? false) ? 'checked' : '' }}
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                        {{ $slot['label'] }}
                                    </label>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
