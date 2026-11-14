<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Control') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-6">Bienvenido al Sistema de Tutorías</h3>
                    
                    <div class="flex flex-wrap gap-4">
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('tutores.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
                                Gestión de Tutores
                            </a>
                        @endif

                        @if(auth()->user()->role === 'estudiante')
                            <a href="{{ route('solicitudes.index') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition">
                                Mis Tutorías
                            </a>
                            <a href="{{ route('solicitudes.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
                                Solicitar Tutoría
                            </a>
                        @endif

                        @if(auth()->user()->role === 'tutor')
                            <a href="{{ route('solicitudes.index') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded transition">
                                Solicitudes Recibidas
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>