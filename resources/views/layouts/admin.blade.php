<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo - EduTutor</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-slate-800 text-white flex flex-col hidden md:flex">
        <div class="h-16 flex items-center px-6 border-b border-slate-700">
            <span class="text-xl font-bold tracking-wider text-blue-400">EduTutor Admin</span>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 bg-slate-700 rounded-lg text-white">Dashboard</a>
            <a href="{{ route('tutores.index') }}" class="block px-4 py-2 hover:bg-slate-700 rounded-lg text-gray-300 hover:text-white transition">Gestión de Tutores</a>
            <!-- Aquí irían más enlaces en el futuro -->
        </nav>
        <div class="p-4 border-t border-slate-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-red-400 hover:bg-slate-700 rounded-lg">Cerrar Sesión</button>
            </form>
        </div>
    </aside>

    <!-- Contenido Principal -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Topbar -->
        <header class="h-16 bg-white shadow-sm flex items-center justify-between px-6 border-b border-gray-200">
            <div class="flex items-center gap-4">
                <h2 class="text-lg font-semibold text-gray-800">@yield('header')</h2>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-sm font-medium text-gray-600">{{ Auth::user()->name }}</span>
                <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </header>

        <!-- Área de Trabajo -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
            @yield('content')
        </main>
    </div>
</body>
</html>