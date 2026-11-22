@extends('layouts.app-modern')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Solicitudes Recibidas</h2>
        <p class="text-gray-500 text-sm mt-1">Gestiona las tutorías que te han solicitado.</p>
    </div>
</div>

@if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Estudiante</th>
                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Materia</th>
                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Fecha y Hora</th>
                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Estado</th>
                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($solicitudes as $solicitud)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $solicitud->student->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $solicitud->materia }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ \Carbon\Carbon::parse($solicitud->fecha)->format('d M, Y') }} - {{ $solicitud->hora }}</td>
                    <td class="px-6 py-4">
                        @if($solicitud->estado == 'pendiente')
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Pendiente</span>
                        @elseif($solicitud->estado == 'aceptada')
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Aceptada</span>
                        @elseif($solicitud->estado == 'rechazada')
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">Rechazada</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm font-medium">
                        @if($solicitud->estado === 'pendiente')
                            <!-- Formulario con campo de mensaje -->
                            <form action="{{ route('solicitudes.update', $solicitud) }}" method="POST" class="flex flex-col gap-2 mt-2">
                                @csrf
                                @method('PUT')
                                
                                <input type="text" name="mensaje_tutor" placeholder="Escribe un mensaje..." class="text-xs border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 w-full" required>
                                
                                <div class="flex gap-2">
                                    <button type="submit" name="estado" value="aceptada" class="bg-green-500 hover:bg-green-600 text-white text-xs px-3 py-1 rounded">Aceptar</button>
                                    <button type="submit" name="estado" value="rechazada" class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1 rounded">Rechazar</button>
                                </div>
                            </form>
                        @elseif($solicitud->estado === 'aceptada')
                            <form action="{{ route('solicitudes.update', $solicitud) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="estado" value="completada">
                                <input type="hidden" name="mensaje_tutor" value="Tutoría completada con éxito.">
                                <button type="submit" class="text-blue-600 hover:text-blue-900 text-xs">Marcar Completada</button>
                            </form>
                        @else
                            <span class="text-gray-400 text-xs">Procesada</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">No tienes solicitudes recibidas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Paginación -->
<div class="mt-6">
    {{ $solicitudes->links() }}
</div>
@endsection