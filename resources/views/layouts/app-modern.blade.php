<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduTutor</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 min-h-screen flex flex-col">

    <!-- Top Navbar -->
    <nav class="bg-white shadow-sm border-b border-gray-200 relative z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-8">
                    <span class="text-xl font-bold text-blue-600">EduTutor</span>
                    <div class="hidden md:flex gap-4">
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Inicio</a>
                        @if(auth()->user()->role === 'estudiante')
                            <a href="{{ route('solicitudes.index') }}" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Mis Tutorías</a>
                            <a href="{{ route('solicitudes.create') }}" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Solicitar</a>
                        @elseif(auth()->user()->role === 'tutor')
                            <a href="{{ route('solicitudes.index') }}" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Solicitudes Recibidas</a>
                        @endif
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    
                    <!-- INICIO CAMPANITA DE NOTIFICACIONES -->
                    @if(auth()->user()->role === 'estudiante')
                        @php
                            $notificaciones = \App\Models\TutoringRequest::where('student_id', Auth::id())
                                ->whereNotNull('mensaje_tutor')
                                ->orderBy('updated_at', 'desc')
                                ->get();
                            $cantidadNotificaciones = $notificaciones->count();
                        @endphp

                        <div class="relative group">
                            <!-- Icono de Campana -->
                            <button class="relative p-2 text-gray-600 hover:text-blue-600 transition focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                                @if($cantidadNotificaciones > 0)
                                    <span class="absolute top-1 right-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-[10px] font-bold text-white">{{ $cantidadNotificaciones }}</span>
                                @endif
                            </button>

                            <!-- Menú desplegable -->
                            <div class="absolute right-0 mt-2 w-72 bg-white rounded-xl shadow-lg border border-gray-100 hidden group-hover:block z-50">
                                <div class="p-3 border-b border-gray-50 bg-gray-50 rounded-t-xl flex justify-between items-center">
                                    <h4 class="text-sm font-bold text-gray-700">Notificaciones</h4>
                                    @if($cantidadNotificaciones > 0)
                                        <span class="text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-medium">{{ $cantidadNotificaciones }} nuevas</span>
                                    @endif
                                </div>
                                <div class="max-h-64 overflow-y-auto">
                                    @forelse($notificaciones as $noti)
                                        <div class="p-3 border-b border-gray-50 hover:bg-gray-50 transition">
                                            <p class="text-xs font-bold text-blue-600">{{ $noti->tutor->user->name }} ({{ $noti->materia }})</p>
                                            <p class="text-xs text-gray-600 mt-1">"{{ $noti->mensaje_tutor }}"</p>
                                            <p class="text-[10px] text-gray-400 mt-1">{{ $noti->updated_at->diffForHumans() }}</p>
                                        </div>
                                    @empty
                                        <div class="p-4 text-center text-sm text-gray-500">No hay mensajes nuevos.</div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- FIN CAMPANITA -->

                    <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium">Salir</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-1 max-w-7xl mx-auto w-full py-8 px-4 sm:px-6 lg:px-8">
        @yield('content')
    </main>
</body>
</html>