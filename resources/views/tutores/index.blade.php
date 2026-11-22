@extends('layouts.admin')

@section('header', 'Gestión de Tutores')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    
    <div class="flex justify-between items-center mb-6">
        <!-- Buscador -->
        <form action="{{ route('tutores.index') }}" method="GET" class="w-72">
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar tutor..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </form>

        <a href="{{ route('tutores.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg flex items-center gap-2 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Nuevo Tutor
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-gray-200 text-sm text-gray-500 uppercase tracking-wider">
                    <th class="pb-3 px-4 font-medium">Nombre</th>
                    <th class="pb-3 px-4 font-medium">Email</th>
                    <th class="pb-3 px-4 font-medium">Especialidad</th>
                    <th class="pb-3 px-4 font-medium">Estado</th>
                    <th class="pb-3 px-4 font-medium">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($tutores as $tutor)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-3 px-4 text-sm font-medium text-gray-900">{{ $tutor->user->name }}</td>
                        <td class="py-3 px-4 text-sm text-gray-600">{{ $tutor->user->email }}</td>
                        <td class="py-3 px-4 text-sm text-gray-600">{{ $tutor->especialidad }}</td>
                        <td class="py-3 px-4">
                            @if($tutor->activo)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Activo</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Inactivo</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-sm font-medium">
                            <a href="{{ route('tutores.edit', $tutor) }}" class="text-blue-600 hover:text-blue-900 mr-3">Editar</a>
                            <form action="{{ route('tutores.destroy', $tutor) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Seguro que deseas eliminar este tutor?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-gray-500">No se encontraron tutores.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-6">
        {{ $tutores->links() }}
    </div>
</div>
@endsection