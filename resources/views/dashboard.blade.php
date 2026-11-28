@extends('layouts.app-modern')

@section('content')
<!-- ========================================== -->
<!-- VISTA PARA EL ADMINISTRADOR (NIVEL GERENCIAL) -->
<!-- ========================================== -->
@if(Auth::user()->role === 'admin')
<div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
    <div>
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Resumen General</h2>
        <p class="text-slate-500 mt-2 text-lg">Bienvenido de nuevo, {{ Auth::user()->name }}. Aquí está el estado actual de la plataforma.</p>
    </div>
    <div class="flex gap-3">
        <a href="{{ route('tutores.index') }}" class="bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 font-semibold py-2.5 px-5 rounded-lg shadow-sm transition-all flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
            Ver Reportes
        </a>
        <a href="{{ route('tutores.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-5 rounded-lg shadow-md shadow-blue-500/20 transition-all flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Nuevo Tutor
        </a>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition-shadow">
        <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
            <svg class="w-24 h-24 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        </div>
        <div class="relative z-10">
            <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-2">Tutores Activos</p>
            <div class="flex items-baseline gap-2">
                <h3 class="text-4xl font-extrabold text-slate-900">{{ $totalTutores ?? 0 }}</h3>
                <span class="text-sm font-medium text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full flex items-center">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    +12%
                </span>
            </div>
            <p class="text-xs text-slate-400 mt-2">En comparación al mes anterior</p>
        </div>
    </div>
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition-shadow">
        <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
            <svg class="w-24 h-24 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /></svg>
        </div>
        <div class="relative z-10">
            <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-2">Estudiantes Registrados</p>
            <div class="flex items-baseline gap-2">
                <h3 class="text-4xl font-extrabold text-slate-900">{{ $totalEstudiantes ?? 0 }}</h3>
                <span class="text-sm font-medium text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full flex items-center">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    +8%
                </span>
            </div>
            <p class="text-xs text-slate-400 mt-2">Creciendo constantemente</p>
        </div>
    </div>
    <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl p-6 shadow-lg shadow-blue-500/20 relative overflow-hidden text-white">
        <div class="absolute top-0 right-0 p-4 opacity-10">
            <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
        </div>
        <div class="relative z-10">
            <p class="text-sm font-semibold text-blue-100 uppercase tracking-wider mb-2">Tutorías Totales</p>
            <div class="flex items-baseline gap-2">
                <h3 class="text-4xl font-extrabold text-white">{{ $totalTutorias ?? 0 }}</h3>
            </div>
            <p class="text-xs text-blue-200 mt-2">Histórico de solicitudes</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold text-slate-800">Actividad de la Plataforma</h3>
        </div>
        <div class="flex items-end justify-between h-48 gap-2 mt-4">
            <div class="w-full bg-slate-100 rounded-t-sm h-[40%] relative group"><div class="absolute bottom-0 w-full bg-blue-500 rounded-t-sm h-full opacity-80 group-hover:opacity-100 transition-opacity"></div></div>
            <div class="w-full bg-slate-100 rounded-t-sm h-[70%] relative group"><div class="absolute bottom-0 w-full bg-blue-500 rounded-t-sm h-full opacity-80 group-hover:opacity-100 transition-opacity"></div></div>
            <div class="w-full bg-slate-100 rounded-t-sm h-[50%] relative group"><div class="absolute bottom-0 w-full bg-blue-500 rounded-t-sm h-full opacity-80 group-hover:opacity-100 transition-opacity"></div></div>
            <div class="w-full bg-slate-100 rounded-t-sm h-[90%] relative group"><div class="absolute bottom-0 w-full bg-blue-600 rounded-t-sm h-full opacity-100"></div></div>
            <div class="w-full bg-slate-100 rounded-t-sm h-[60%] relative group"><div class="absolute bottom-0 w-full bg-blue-500 rounded-t-sm h-full opacity-80 group-hover:opacity-100 transition-opacity"></div></div>
            <div class="w-full bg-slate-100 rounded-t-sm h-[80%] relative group"><div class="absolute bottom-0 w-full bg-blue-500 rounded-t-sm h-full opacity-80 group-hover:opacity-100 transition-opacity"></div></div>
            <div class="w-full bg-slate-100 rounded-t-sm h-[100%] relative group"><div class="absolute bottom-0 w-full bg-blue-500 rounded-t-sm h-full opacity-80 group-hover:opacity-100 transition-opacity"></div></div>
        </div>
        <div class="flex justify-between mt-4 text-xs font-medium text-slate-400">
            <span>Lun</span><span>Mar</span><span>Mié</span><span>Jue</span><span>Vie</span><span>Sáb</span><span>Dom</span>
        </div>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
        <h3 class="text-lg font-bold text-slate-800 mb-4">Accesos Rápidos</h3>
        <div class="space-y-3">
            <a href="{{ route('tutores.index') }}" class="flex items-center p-3 rounded-xl hover:bg-slate-50 border border-transparent hover:border-slate-200 transition-all group">
                <div class="h-10 w-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-slate-800">Gestionar Tutores</h4>
                    <p class="text-xs text-slate-500">Editar o eliminar perfiles</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endif

<!-- ========================================== -->
<!-- VISTA PARA EL ESTUDIANTE                   -->
<!-- ========================================== -->
@if(Auth::user()->role === 'estudiante')
<div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <div>
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">¡Hola, {{ Auth::user()->name }}! </h2>
        <p class="text-slate-500 mt-1 text-lg">Este es el resumen de tu actividad académica.</p>
    </div>
    <a href="{{ route('solicitudes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-6 rounded-xl shadow-lg shadow-blue-500/30 transition-all flex items-center gap-2 transform hover:-translate-y-0.5">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Nueva Solicitud
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- KPI Pendientes -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 relative overflow-hidden group">
        <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
            <svg class="w-24 h-24 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div class="relative z-10">
            <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-2">Pendientes</p>
            <h3 class="text-4xl font-extrabold text-slate-900">{{ $pendientes ?? 0 }}</h3>
            <p class="text-xs text-slate-400 mt-2">Esperando confirmación</p>
        </div>
    </div>

    <!-- KPI Aceptadas -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 relative overflow-hidden group">
        <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
            <svg class="w-24 h-24 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div class="relative z-10">
            <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-2">Aceptadas</p>
            <h3 class="text-4xl font-extrabold text-slate-900">{{ $aceptadas ?? 0 }}</h3>
            <p class="text-xs text-slate-400 mt-2">Listas para tu sesión</p>
        </div>
    </div>

    <!-- KPI Completadas -->
    <div class="bg-gradient-to-br from-indigo-500 to-blue-600 rounded-2xl p-6 shadow-lg shadow-blue-500/20 relative overflow-hidden text-white">
        <div class="absolute top-0 right-0 p-4 opacity-10">
            <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <div class="relative z-10">
            <p class="text-sm font-semibold text-blue-100 uppercase tracking-wider mb-2">Completadas</p>
            <h3 class="text-4xl font-extrabold text-white">{{ $completadas ?? 0 }}</h3>
            <p class="text-xs text-blue-200 mt-2">Sesiones finalizadas</p>
        </div>
    </div>
</div>

<!-- Últimas Tutorías -->
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
        <h3 class="text-lg font-bold text-slate-800">Tus últimas tutorías</h3>
        <a href="{{ route('solicitudes.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg transition-colors">Ver todas</a>
    </div>
    <table class="w-full text-left border-collapse">
        <tbody class="divide-y divide-slate-100">
            @forelse($ultimasTutorias ?? [] as $tutoria)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold shadow-sm">
                                {{ substr($tutoria->tutor->user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-900">{{ $tutoria->tutor->user->name }}</p>
                                <p class="text-xs font-medium text-slate-500">{{ $tutoria->materia }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-slate-600">
                        {{ \Carbon\Carbon::parse($tutoria->fecha)->format('d M, Y') }} - {{ $tutoria->hora }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        @if($tutoria->estado == 'pendiente')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700 border border-amber-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Pendiente
                            </span>
                        @elseif($tutoria->estado == 'aceptada')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700 border border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aceptada
                            </span>
                        @elseif($tutoria->estado == 'rechazada')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 border border-red-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Rechazada
                            </span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-12 text-center text-slate-500">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            <p class="text-sm font-medium">Aún no has solicitado ninguna tutoría.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endif

<!-- ========================================== -->
<!-- VISTA PARA EL TUTOR                        -->
<!-- ========================================== -->
@if(Auth::user()->role === 'tutor')
<div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <div>
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Panel del Tutor</h2>
        <p class="text-slate-500 mt-1 text-lg">Hola {{ Auth::user()->name }}, aquí tienes tus solicitudes pendientes.</p>
    </div>
    <a href="{{ route('solicitudes.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-6 rounded-xl shadow-lg shadow-indigo-500/30 transition-all flex items-center gap-2">
        Ver Bandeja Completa
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- KPI Solicitudes Nuevas -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border-l-4 border-l-amber-500 border-y border-r border-slate-100">
        <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Solicitudes Nuevas</p>
        <div class="flex items-end gap-3">
            <h3 class="text-4xl font-extrabold text-slate-900">{{ $pendientes ?? 0 }}</h3>
            <span class="text-sm font-medium text-amber-600 mb-1">Requieren acción</span>
        </div>
    </div>

    <!-- KPI Tutorías Aceptadas -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border-l-4 border-l-emerald-500 border-y border-r border-slate-100">
        <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Tutorías Aceptadas</p>
        <div class="flex items-end gap-3">
            <h3 class="text-4xl font-extrabold text-slate-900">{{ $aceptadas ?? 0 }}</h3>
            <span class="text-sm font-medium text-emerald-600 mb-1">En agenda</span>
        </div>
    </div>

    <!-- KPI Completadas -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border-l-4 border-l-blue-500 border-y border-r border-slate-100">
        <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Completadas</p>
        <div class="flex items-end gap-3">
            <h3 class="text-4xl font-extrabold text-slate-900">{{ $completadas ?? 0 }}</h3>
            <span class="text-sm font-medium text-blue-600 mb-1">Histórico</span>
        </div>
    </div>
</div>

<!-- Tabla de Solicitudes Recientes para el Tutor -->
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
        <h3 class="text-lg font-bold text-slate-800">Solicitudes Recientes</h3>
    </div>
    <table class="w-full text-left border-collapse">
        <tbody class="divide-y divide-slate-100">
            @forelse($ultimasTutorias ?? [] as $tutoria)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="h-10 w-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold shadow-sm">
                                {{ substr($tutoria->student->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-900">{{ $tutoria->student->name }}</p>
                                <p class="text-xs font-medium text-slate-500">{{ $tutoria->materia }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-slate-600">
                        {{ \Carbon\Carbon::parse($tutoria->fecha)->format('d M, Y') }} - {{ $tutoria->hora }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        @if($tutoria->estado == 'pendiente')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700 border border-amber-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Pendiente
                            </span>
                        @elseif($tutoria->estado == 'aceptada')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700 border border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aceptada
                            </span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-12 text-center text-slate-500">
                        <p class="text-sm font-medium">No tienes solicitudes por ahora.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endif

@endsection