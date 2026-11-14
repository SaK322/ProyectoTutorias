<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Solicitar Tutoría') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('solicitudes.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Selecciona un Tutor</label>
                            <select name="tutor_id" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                                <option value="">-- Seleccione --</option>
                                @foreach($tutores as $tutor)
                                    <option value="{{ $tutor->id }}">{{ $tutor->user->name }} ({{ $tutor->especialidad }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Materia</label>
                            <input type="text" name="materia" value="{{ old('materia') }}" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                        </div>

                        <div class="flex space-x-4 mb-6">
                            <div class="w-1/2">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Fecha</label>
                                <input type="date" name="fecha" value="{{ old('fecha') }}" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                            </div>
                            <div class="w-1/2">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Hora</label>
                                <input type="time" name="hora" value="{{ old('hora') }}" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Enviar Solicitud
                            </button>
                            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900">Cancelar</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>