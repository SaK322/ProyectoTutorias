<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Mis Tutorías Solicitadas') }}
            </h2>
            <a href="{{ route('solicitudes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Nueva Solicitud
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tutor</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Materia</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha y Hora</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($solicitudes as $solicitud)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $solicitud->tutor->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $solicitud->materia }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $solicitud->fecha }} a las {{ $solicitud->hora }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($solicitud->estado == 'pendiente') bg-yellow-100 text-yellow-800 
                                            @elseif($solicitud->estado == 'aceptada') bg-green-100 text-green-800 
                                            @elseif($solicitud->estado == 'rechazada') bg-red-100 text-red-800 
                                            @else bg-blue-100 text-blue-800 @endif">
                                            {{ ucfirst($solicitud->estado) }}
                                        </span>
                                        @if($solicitud->motivo_rechazo)
                                            <p class="text-xs text-red-500 mt-1">{{ $solicitud->motivo_rechazo }}</p>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">No has solicitado tutorías.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>