<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-700 leading-tight">
            Crear Nueva Reserva
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">

            @if($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('reservas.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="servicio" class="block text-sm font-medium text-gray-700">Servicio</label>
                    <input type="text" name="servicio" id="servicio" value="{{ old('servicio') }}"
                        class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                    <input type="date" name="fecha" id="fecha" value="{{ old('fecha') }}"
                        class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="hora" class="block text-sm font-medium text-gray-700">Hora</label>
                    <input type="time" name="hora" id="hora" value="{{ old('hora') }}"
                        class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>

                <div class="flex justify-between mt-6">
                    <a href="{{ route('reservas.index') }}" class="text-sm text-blue-500 hover:underline">Volver</a>
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
                        Crear reserva
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>