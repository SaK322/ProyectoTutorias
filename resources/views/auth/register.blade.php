<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registrarse - TutorLink</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('img/favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex">
        <!-- Lado Izquierdo: Branding -->
        <div class="hidden lg:flex w-1/2 bg-gradient-to-br from-indigo-900 to-blue-700 items-center justify-center p-12 relative overflow-hidden">
            <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-white opacity-10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-blue-400 opacity-20 rounded-full blur-3xl"></div>
            
            <div class="relative z-10 text-center">
                <div class="flex justify-center mb-6">
                    <div class="p-4 bg-white/10 rounded-2xl backdrop-blur-sm border border-white/20">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>
                </div>
                <h1 class="text-4xl font-bold text-white mb-4">Únete a TutorLink</h1>
                <p class="text-blue-100 text-lg max-w-md mx-auto">Crea tu cuenta para comenzar a gestionar tus tutorías académicas de forma rápida y segura.</p>
            </div>
        </div>

        <!-- Lado Derecho: Formulario -->
        <div class="w-full lg:w-1/2 flex items-center justify-center bg-gray-50 p-8">
            <div class="w-full max-w-md">
                <!-- Logo para móviles -->
                <div class="lg:hidden text-center mb-8">
                    <span class="text-3xl font-bold text-blue-600">TutorLink</span>
                </div>

                <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                    <div class="text-center mb-8">
                        <h2 class="text-2xl font-bold text-gray-900">Crear una cuenta</h2>
                        <p class="text-gray-500 mt-2 text-sm">Ingresa tus datos para registrarte.</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf

                        <!-- Nombre -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre Completo</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition sm:text-sm"
                                    placeholder="Tu nombre completo">
                            </div>
                            @error('name')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                </div>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition sm:text-sm"
                                    placeholder="correo@ejemplo.com">
                            </div>
                            @error('email')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input id="password" type="password" name="password" required
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition sm:text-sm"
                                    placeholder="••••••••">
                            </div>
                            @error('password')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmar Contraseña</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <input id="password_confirmation" type="password" name="password_confirmation" required
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition sm:text-sm"
                                    placeholder="••••••••">
                            </div>
                            @error('password_confirmation')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Botón -->
                        <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 mt-6">
                            Registrarse
                        </button>
                    </form>

                    <!-- Link a Login -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            ¿Ya tienes una cuenta?
                            <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">Inicia sesión aquí</a>
                        </p>
                    </div>
                </div>
                
                <!-- Footer -->
                <p class="text-center text-xs text-gray-400 mt-8">
                    &copy; {{ date('Y') }} TutorLink. Todos los derechos reservados.
                </p>
            </div>
        </div>
    </div>
</body>
</html>