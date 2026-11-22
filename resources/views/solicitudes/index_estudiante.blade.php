@extends('layouts.app-modern')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Mis Tutorías</h2>
        <p class="text-gray-500 text-sm mt-1">Gestiona tus solicitudes académicas.</p>
    </div>
    <a href="{{ route('solicitudes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">Nueva Solicitud</a>
</div>

<!-- TABLA DE TUTORÍAS -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Tutor</th>
                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Materia</th>
                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Fecha</th>
                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Estado</th>
                <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($solicitudes as $solicitud)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $solicitud->tutor->user->name }}</td>
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
                        <!-- Lógica de Acciones Corregida -->
                        @if($solicitud->estado === 'pendiente')
                            <a href="{{ route('solicitudes.edit', $solicitud->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">Editar</a>
                        @endif

                        @if($solicitud->estado !== 'completada' && $solicitud->estado !== 'rechazada')
                            <!-- Botón que abre el Modal -->
                            <button type="button" onclick="abrirModal({{ $solicitud->id }})" class="text-red-600 hover:text-red-900">Cancelar</button>
                            
                            <!-- Formulario Oculto (Sin el onsubmit feo) -->
                            <form id="form-cancelar-{{ $solicitud->id }}" action="{{ route('solicitudes.destroy', $solicitud->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endif

                        @if($solicitud->estado === 'completada' || $solicitud->estado === 'rechazada')
                            <span class="text-gray-400 text-xs italic">Finalizada</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">No tienes tutorías registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- MODAL PROFESIONAL DE CANCELACIÓN -->
<div id="modal-cancelar" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50 transition-opacity">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 overflow-hidden transform scale-95 transition-transform duration-300">
        <div class="p-6">
            <div class="flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mx-auto mb-4">
                <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-center text-gray-900 mb-2">¿Cancelar Tutoría?</h3>
            <p class="text-sm text-center text-gray-500 mb-6">Esta acción notificará al tutor y liberará el espacio. Esta acción no se puede deshacer.</p>
            
            <div class="flex gap-3">
                <button type="button" onclick="cerrarModal()" class="flex-1 bg-white border border-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg hover:bg-gray-50 transition">Volver atrás</button>
                <button type="button" onclick="confirmarCancelacion()" class="flex-1 bg-red-600 text-white font-medium py-2 px-4 rounded-lg hover:bg-red-700 transition">Sí, cancelar</button>
            </div>
        </div>
    </div>
</div>

<!-- JAVASCRIPT PARA EL MODAL -->
<script>
    let solicitudIdParaCancelar = null;

    function abrirModal(id) {
        solicitudIdParaCancelar = id;
        const modal = document.getElementById('modal-cancelar');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            modal.querySelector('.transform').classList.remove('scale-95');
            modal.querySelector('.transform').classList.add('scale-100');
        }, 10);
    }

    function cerrarModal() {
        const modal = document.getElementById('modal-cancelar');
        modal.querySelector('.transform').classList.remove('scale-100');
        modal.querySelector('.transform').classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 200);
    }

    function confirmarCancelacion() {
        if (solicitudIdParaCancelar) {
            document.getElementById(`form-cancelar-${solicitudIdParaCancelar}`).submit();
        }
    }
</script>
@endsection