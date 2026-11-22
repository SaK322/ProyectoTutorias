@extends('layouts.app-modern')

@section('content')
<div class="mb-8 flex justify-between items-end">
    <div>
        <h2 class="text-3xl font-bold text-gray-800">¡Hola, {{ Auth::user()->name }}!</h2>
        <p class="text-gray-500 mt-2">Bienvenido a tu panel de control.</p>
    </div>
    
    @if(Auth::user()->role === 'estudiante')
        <a href="{{ route('solicitudes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-medium transition shadow-sm flex items-center gap-2">
            Nueva Tutoría
        </a>
    @elseif(Auth::user()->role === 'admin')
        <a href="{{ route('tutores.create') }}" class="bg-slate-800 hover:bg-slate-900 text-white px-5 py-2.5 rounded-lg font-medium transition shadow-sm flex items-center gap-2">
            Registrar Tutor
        </a>
    @endif
</div>

<!-- ========================================== -->
<!-- VISTA PARA EL ESTUDIANTE                   -->
<!-- ========================================== -->
@if(Auth::user()->role === 'estudiante')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-500 mb-1">Pendientes</p>
            <h3 class="text-3xl font-bold text-gray-800">{{ $pendientes }}</h3>
        </div>
        <div class="h-12 w-12 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-500 mb-1">Aceptadas</p>
            <h3 class="text-3xl font-bold text-gray-800">{{ $aceptadas }}</h3>
        </div>
        <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center text-green-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-500 mb-1">Completadas</p>
            <h3 class="text-3xl font-bold text-gray-800">{{ $completadas }}</h3>
        </div>
        <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
    </div>
</div>
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
        <h3 class="text-lg font-bold text-gray-800">Tus últimas tutorías</h3>
        <a href="{{ route('solicitudes.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Ver todas</a>
    </div>
    <table class="w-full text-left border-collapse">
        <tbody class="divide-y divide-gray-100">
            @forelse($ultimasTutorias as $tutoria)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <p class="text-sm font-medium text-gray-900">{{ $tutoria->tutor->user->name }}</p>
                        <p class="text-xs text-gray-500">{{ $tutoria->materia }}</p>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $tutoria->fecha }} - {{ $tutoria->hora }}</td>
                    <td class="px-6 py-4 text-right">
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium 
                        @if($tutoria->estado == 'pendiente') bg-yellow-100 text-yellow-800 
                        @elseif($tutoria->estado == 'aceptada') bg-green-100 text-green-800 
                        @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst($tutoria->estado) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="px-6 py-8 text-center text-gray-500">No tienes tutorías aún.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endif


<!-- ========================================== -->
<!-- VISTA PARA EL TUTOR                        -->
<!-- ========================================== -->
@if(Auth::user()->role === 'tutor')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center justify-between border-l-4 border-l-yellow-400">
        <div>
            <p class="text-sm font-medium text-gray-500 mb-1">Solicitudes Nuevas</p>
            <h3 class="text-3xl font-bold text-gray-800">{{ $pendientes }}</h3>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center justify-between border-l-4 border-l-green-400">
        <div>
            <p class="text-sm font-medium text-gray-500 mb-1">Tutorías Aceptadas</p>
            <h3 class="text-3xl font-bold text-gray-800">{{ $aceptadas }}</h3>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center justify-between border-l-4 border-l-blue-400">
        <div>
            <p class="text-sm font-medium text-gray-500 mb-1">Completadas</p>
            <h3 class="text-3xl font-bold text-gray-800">{{ $completadas }}</h3>
        </div>
    </div>
</div>
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
        <h3 class="text-lg font-bold text-gray-800">Solicitudes recientes</h3>
        <a href="{{ route('solicitudes.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Ver bandeja</a>
    </div>
    <table class="w-full text-left border-collapse">
        <tbody class="divide-y divide-gray-100">
            @forelse($ultimasTutorias as $tutoria)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <p class="text-sm font-medium text-gray-900">{{ $tutoria->student->name }}</p>
                        <p class="text-xs text-gray-500">{{ $tutoria->materia }}</p>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $tutoria->fecha }} - {{ $tutoria->hora }}</td>
                    <td class="px-6 py-4 text-right">
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium 
                        @if($tutoria->estado == 'pendiente') bg-yellow-100 text-yellow-800 
                        @elseif($tutoria->estado == 'aceptada') bg-green-100 text-green-800 
                        @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst($tutoria->estado) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="px-6 py-8 text-center text-gray-500">No tienes solicitudes aún.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endif


<!-- ========================================== -->
<!-- VISTA PARA EL ADMINISTRADOR                -->
<!-- ========================================== -->
@if(Auth::user()->role === 'admin')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 text-center">
        <p class="text-sm font-medium text-gray-500 mb-1">Tutores Registrados</p>
        <h3 class="text-4xl font-extrabold text-blue-600">{{ $totalTutores }}</h3>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 text-center">
        <p class="text-sm font-medium text-gray-500 mb-1">Estudiantes en el Sistema</p>
        <h3 class="text-4xl font-extrabold text-green-600">{{ $totalEstudiantes }}</h3>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 text-center">
        <p class="text-sm font-medium text-gray-500 mb-1">Total de Tutorías (Histórico)</p>
        <h3 class="text-4xl font-extrabold text-purple-600">{{ $totalTutorias }}</h3>
    </div>
</div>
<div class="bg-slate-800 rounded-xl shadow-sm p-8 text-center">
    <h3 class="text-2xl font-bold text-white mb-2">Panel de Administración</h3>
    <p class="text-slate-400 mb-6">Desde aquí puedes gestionar la oferta académica de tutores de la institución.</p>
    <a href="{{ route('tutores.index') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-8 rounded-lg transition">Ir a Gestión de Tutores</a>
</div>
@endif

@endsection