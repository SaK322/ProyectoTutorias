<?php

namespace App\Http\Controllers;

use App\Models\TutoringRequest;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TutoringRequestController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'estudiante') {
            $solicitudes = TutoringRequest::with(['tutor.user'])
                ->where('student_id', $user->id)
                ->orderBy('fecha', 'desc')
                ->paginate(10); // Agregamos paginación
            return view('solicitudes.index_estudiante', compact('solicitudes'));
        }

        if ($user->role === 'tutor') {
            $tutor = $user->tutor;
            $solicitudes = TutoringRequest::with(['student'])
                ->where('tutor_id', $tutor->id)
                ->orderBy('fecha', 'desc')
                ->paginate(10);
            return view('solicitudes.index_tutor', compact('solicitudes'));
        }

        abort(403);
    }

    public function create()
    {
        $tutores = Tutor::with('user')->where('activo', true)->get();
        return view('solicitudes.create', compact('tutores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tutor_id' => 'required|exists:tutors,id',
            'materia' => 'required|string|max:255',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required',
        ]);

        TutoringRequest::create([
            'student_id' => Auth::id(),
            'tutor_id' => $request->tutor_id,
            'materia' => $request->materia,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'estado' => 'pendiente',
        ]);

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud enviada. Espera la confirmación del tutor.');
    }

    public function update(Request $request, TutoringRequest $solicitud)
    {
        // NUEVO: Si el estudiante está editando los datos (fecha, hora, etc.)
        if (Auth::user()->role === 'estudiante') {
            $request->validate([
                'tutor_id' => 'required|exists:tutors,id',
                'materia' => 'required|string|max:255',
                'fecha' => 'required|date|after_or_equal:today',
                'hora' => 'required',
            ]);

            $solicitud->update([
                'tutor_id' => $request->tutor_id,
                'materia' => $request->materia,
                'fecha' => $request->fecha,
                'hora' => $request->hora,
            ]);

            return redirect()->route('solicitudes.index')->with('success', 'Solicitud actualizada correctamente.');
        }

        // Esto se mantiene igual para el Tutor
        $request->validate([
            'estado' => 'required|in:aceptada,rechazada,completada',
            'mensaje_tutor' => 'nullable|string'
        ]);

        $solicitud->update([
            'estado' => $request->estado,
            'mensaje_tutor' => $request->mensaje_tutor,
            // Si es rechazada, guardamos el motivo en la columna antigua para no romper la BD
            'motivo_rechazo' => $request->estado === 'rechazada' ? $request->mensaje_tutor : null,
        ]);

        return redirect()->route('solicitudes.index')->with('success', 'Estado de la tutoría actualizado y notificado.');
    }

    public function edit(TutoringRequest $solicitud)
    {
        if ($solicitud->estado !== 'pendiente') {
            return redirect()->route('solicitudes.index')->with('error', 'Solo puedes editar tutorías pendientes.');
        }
        
        $tutores = Tutor::with('user')->where('activo', true)->get();
        return view('solicitudes.edit', compact('solicitud', 'tutores'));
    }

    public function destroy(TutoringRequest $solicitud)
    {
        // Ahora permite cancelar si está pendiente o aceptada
        if ($solicitud->estado !== 'completada' && $solicitud->estado !== 'rechazada') {
            $solicitud->delete();
            return redirect()->route('solicitudes.index')->with('success', 'La tutoría ha sido cancelada correctamente.');
        }
        
        return redirect()->route('solicitudes.index')->with('error', 'No puedes cancelar una tutoría que ya ha finalizado.');
    }
}