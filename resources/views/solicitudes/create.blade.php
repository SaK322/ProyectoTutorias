@extends('layouts.app-modern')

@section('content')
<div class="max-w-3xl mx-auto py-4">
    <!-- Encabezado -->
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-bold text-gray-800">Solicitar una Tutoría</h2>
        <p class="text-gray-500 mt-2">Completa los siguientes pasos para agendar tu sesión de apoyo académico.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden relative">
        <!-- Barra decorativa superior (Color verde estudiante) -->
        <div class="h-2 w-full bg-gradient-to-r from-teal-400 to-emerald-500"></div>

        <div class="p-6 md:p-10">
            <!-- Errores de Validación -->
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-8">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('solicitudes.store') }}" method="POST">
                @csrf
                
                <div class="space-y-8">
                    <!-- PASO 1: Tutor -->
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-full bg-teal-100 text-teal-600 flex items-center justify-center font-bold text-sm">1</div>
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-bold text-gray-800 mb-2">Selecciona a tu Tutor</label>
                            <div class="relative">
                                <select name="tutor_id" class="block w-full pl-4 pr-10 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition sm:text-sm bg-gray-50 hover:bg-white" required>
                                    <option value="">-- Elige un profesor --</option>
                                    @foreach($tutores as $tutor)
                                        <option value="{{ $tutor->id }}">{{ $tutor->user->name }} ({{ $tutor->especialidad }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- PASO 2: Materia -->
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-full bg-teal-100 text-teal-600 flex items-center justify-center font-bold text-sm">2</div>
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-bold text-gray-800 mb-2">¿Qué materia necesitas repasar?</label>
                            <input type="text" name="materia" value="{{ old('materia') }}" 
                                class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition sm:text-sm bg-gray-50 hover:bg-white" 
                                placeholder="Ej. Cálculo II, Programación..." required>
                        </div>
                    </div>

                    <!-- PASO 3: Fecha y Hora -->
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-full bg-teal-100 text-teal-600 flex items-center justify-center font-bold text-sm">3</div>
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-bold text-gray-800 mb-2">¿Cuándo te gustaría?</label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <input type="date" name="fecha" value="{{ old('fecha') }}" 
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition sm:text-sm bg-gray-50 hover:bg-white" required>
                                </div>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <input type="time" name="hora" value="{{ old('hora') }}" 
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition sm:text-sm bg-gray-50 hover:bg-white" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botones -->
                <div class="mt-10 pt-6 border-t border-gray-100 flex items-center justify-between">
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-500 hover:text-gray-800 transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Volver al inicio
                    </a>
                    <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3 px-8 rounded-xl transition shadow-lg shadow-emerald-200 flex items-center gap-2">
                        Enviar Solicitud
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection