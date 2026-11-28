<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TutorLink</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('img/favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f8fafc] min-h-screen flex flex-col antialiased text-slate-800">

    <!-- Top Navbar (Sticky y con efecto cristal) -->
    <nav class="bg-white/80 backdrop-blur-md sticky top-0 border-b border-slate-200 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <!-- Logo y Enlaces -->
                <div class="flex items-center gap-10">
                    <!-- Logo -->
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                        <div class="p-1.5 bg-blue-50 rounded-lg group-hover:bg-blue-100 transition-colors">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-slate-900 tracking-tight">TutorLink</span>
                    </a>

                    <!-- Enlaces de Navegación -->
                    <div class="hidden md:flex gap-2">
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all {{ request()->routeIs('dashboard') ? 'text-blue-600 bg-blue-50' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-100' }}">
                            Inicio
                        </a>
                        
                        @if(auth()->user()->role === 'estudiante')
                            <a href="{{ route('solicitudes.index') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all {{ request()->routeIs('solicitudes.index') ? 'text-blue-600 bg-blue-50' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-100' }}">
                                Mis Tutorías
                            </a>
                            <a href="{{ route('solicitudes.create') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all {{ request()->routeIs('solicitudes.create') ? 'text-blue-600 bg-blue-50' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-100' }}">
                                Solicitar
                            </a>
                        @elseif(auth()->user()->role === 'tutor')
                            <a href="{{ route('solicitudes.index') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all {{ request()->routeIs('solicitudes.index') ? 'text-blue-600 bg-blue-50' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-100' }}">
                                Solicitudes Recibidas
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Zona de Usuario y Notificaciones -->
                <div class="flex items-center gap-4">
                    
                    <!-- CAMPANITA DE NOTIFICACIONES -->
                    @if(auth()->user()->role === 'estudiante')
                        @php
                            $notificaciones = \App\Models\TutoringRequest::where('student_id', Auth::id())
                                ->whereNotNull('mensaje_tutor')
                                ->orderBy('updated_at', 'desc')
                                ->get();
                            $cantidadNotificaciones = $notificaciones->count();
                        @endphp

                        <div class="relative group">
                            <button class="relative p-2 text-slate-400 hover:text-blue-600 bg-slate-50 hover:bg-blue-50 rounded-full transition-all focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                                @if($cantidadNotificaciones > 0)
                                    <span class="absolute top-0 right-0 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-[10px] font-bold text-white border-2 border-white">{{ $cantidadNotificaciones }}</span>
                                @endif
                            </button>

                            <!-- Menú desplegable de notificaciones -->
                            <div class="absolute right-0 mt-3 w-80 bg-white rounded-xl shadow-xl border border-slate-100 hidden group-hover:block z-50 overflow-hidden transform origin-top-right transition-all">
                                <div class="p-4 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
                                    <h4 class="text-sm font-bold text-slate-800">Notificaciones</h4>
                                    @if($cantidadNotificaciones > 0)
                                        <span class="text-[10px] bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-bold uppercase tracking-wide">{{ $cantidadNotificaciones }} nuevas</span>
                                    @endif
                                </div>
                                <div class="max-h-80 overflow-y-auto">
                                    @forelse($notificaciones as $noti)
                                        <div class="p-4 border-b border-slate-50 hover:bg-slate-50 transition-colors">
                                            <div class="flex gap-3">
                                                <div class="flex-shrink-0 mt-1">
                                                    <div class="h-8 w-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs">
                                                        {{ substr($noti->tutor->user->name, 0, 1) }}
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-bold text-slate-800">{{ $noti->tutor->user->name }}</p>
                                                    <p class="text-xs text-slate-500">{{ $noti->materia }}</p>
                                                    <p class="text-sm text-slate-700 mt-2 bg-blue-50/50 p-2 rounded-lg border border-blue-100/50">"{{ $noti->mensaje_tutor }}"</p>
                                                    <p class="text-[10px] font-medium text-slate-400 mt-2">{{ $noti->updated_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="p-8 text-center">
                                            <p class="text-sm text-slate-500">No tienes mensajes nuevos.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Separador -->
                    <div class="h-6 w-px bg-slate-200 hidden sm:block"></div>

                    <!-- Perfil de Usuario -->
                    <div class="flex items-center gap-3">
                        <div class="hidden sm:block text-right">
                            <p class="text-sm font-bold text-slate-800 leading-tight">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-slate-500 capitalize">{{ Auth::user()->role }}</p>
                        </div>
                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold shadow-sm">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </div>

                    <!-- Botón Salir -->
                    <form method="POST" action="{{ route('logout') }}" class="ml-2">
                        @csrf
                        <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-full transition-colors" title="Cerrar Sesión">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="flex-1 w-full max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        @yield('content')
    </main>
</body>
</html>