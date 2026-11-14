<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Solicitudes Recibidas') }}
        </h2>
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estudiante</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Materia</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha y Hora</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($solicitudes as $solicitud)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $solicitud->student->name }}</td>
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
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        @if($solicitud->estado === 'pendiente')
                                            <form action="{{ route('solicitudes.update', $solicitud) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="estado" value="aceptada">
                                                <button type="submit" class="text-green-600 hover:text-green-900 mr-3">Aceptar</button>
                                            </form>
                                            <form action="{{ route('solicitudes.update', $solicitud) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="estado" value="rechazada">
                                                <input type="hidden" name="motivo_rechazo" value="No disponible en ese horario">
                                                <button type="submit" class="text-red-600 hover:text-red-900">Rechazar</button>
                                            </form>
                                        @elseif($solicitud->estado === 'aceptada')
                                            <form action="{{ route('solicitudes.update', $solicitud) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="estado" value="completada">
                                                <button type="submit" class="text-blue-600 hover:text-blue-900">Marcar Completada</button>
                                            </form>
                                        @else
                                            <span class="text-gray-400">Sin acciones</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">No tienes solicitudes recibidas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>