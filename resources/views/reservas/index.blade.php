<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-700 leading-tight">
            Mis Reservas
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

            <a href="{{ route('reservas.create') }}"
               class="mb-4 inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded transition-colors duration-300 ease-in-out">
                Crear nueva reserva
            </a>

            @if(session('success'))
                <div 
                    x-data="{ show: true }" 
                    x-show="show" 
                    x-init="setTimeout(() => show = false, 4000)" 
                    x-transition
                    class="bg-green-200 text-green-800 p-3 rounded mb-4"
                >
                    {{ session('success') }}
                </div>
            @endif

            <form method="GET" action="{{ route('reservas.index') }}" class="mb-4 flex flex-wrap gap-4">
                <input type="date" name="fecha" value="{{ request('fecha') }}" class="rounded border-gray-300" />

                <select name="estado" class="rounded border-gray-300">
                    <option value="">-- Estado --</option>
                    <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="confirmada" {{ request('estado') == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                    <option value="cancelada" {{ request('estado') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                </select>

                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded transition-colors duration-300 ease-in-out">
                    Filtrar
                </button>

                <a href="{{ route('reservas.index') }}" class="text-sm text-blue-500 hover:underline self-center">Limpiar</a>
            </form>

            @if($reservas->count())
                <table class="min-w-full bg-white shadow-md rounded">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-300 text-left">Servicio</th>
                            <th class="py-2 px-4 border-b border-gray-300 text-left">Fecha</th>
                            <th class="py-2 px-4 border-b border-gray-300 text-left">Hora</th>
                            <th class="py-2 px-4 border-b border-gray-300 text-left">Estado</th>
                            <th class="py-2 px-4 border-b border-gray-300 text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservas as $reserva)
                        <tr 
                            x-data="{ show: false }" 
                            x-init="show = true" 
                            x-show="show" 
                            x-transition
                            class="hover:bg-gray-100"
                        >
                            <td class="border-b border-gray-300 py-2 px-4">{{ $reserva->servicio }}</td>
                            <td class="border-b border-gray-300 py-2 px-4">{{ \Carbon\Carbon::parse($reserva->fecha)->format('d/m/Y') }}</td>
                            <td class="border-b border-gray-300 py-2 px-4">{{ $reserva->hora }}</td>
                            <td class="border-b border-gray-300 py-2 px-4">
                                @php
                                $color = match($reserva->estado) {
                                    'confirmada' => 'bg-green-400 text-white',
                                    'pendiente' => 'bg-yellow-400 text-gray-900',
                                    'cancelada' => 'bg-red-400 text-white',
                                    default => 'bg-gray-300 text-gray-700',
                                };
                                @endphp
                                <span class="px-3 py-1 rounded-full font-semibold {{ $color }}">
                                    {{ ucfirst($reserva->estado) }}
                                </span>
                            </td>
                            <td class="border-b border-gray-300 py-2 px-4 whitespace-nowrap">
                                <a href="{{ route('reservas.edit', $reserva) }}" class="text-green-600 hover:underline mr-4 transition-colors duration-300 ease-in-out">Editar</a>

                                <form action="{{ route('reservas.destroy', $reserva) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar esta reserva?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline transition-colors duration-300 ease-in-out">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No tienes reservas aún.</p>
            @endif

        </div>
    </div>

    <!-- Incluye Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>
</x-app-layout>