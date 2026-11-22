@extends('layouts.app-modern')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Editar Tutoría</h2>
        <p class="text-gray-500 text-sm mt-1">Modifica los detalles de tu solicitud.</p>
    </div>
    <a href="{{ route('solicitudes.index') }}" class="text-gray-600 hover:text-gray-900 font-medium">Volver atrás</a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 max-w-2xl">
    <form action="{{ route('solicitudes.update', $solicitud->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Tutor</label>
            <select name="tutor_id" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                @foreach($tutores as $tutor)
                    <option value="{{ $tutor->id }}" {{ $solicitud->tutor_id == $tutor->id ? 'selected' : '' }}>
                        {{ $tutor->user->name }} ({{ $tutor->especialidad }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Materia</label>
            <input type="text" name="materia" value="{{ $solicitud->materia }}" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
        </div>

        <div class="flex gap-4 mb-6">
            <div class="w-1/2">
                <label class="block text-gray-700 text-sm font-bold mb-2">Fecha</label>
                <input type="date" name="fecha" value="{{ $solicitud->fecha }}" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
            </div>
            <div class="w-1/2">
                <label class="block text-gray-700 text-sm font-bold mb-2">Hora</label>
                <input type="time" name="hora" value="{{ $solicitud->hora }}" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
            </div>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>
@endsection