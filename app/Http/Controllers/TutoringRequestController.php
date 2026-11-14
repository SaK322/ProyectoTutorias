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
                ->get();
            return view('solicitudes.index_estudiante', compact('solicitudes'));
        }

        if ($user->role === 'tutor') {
            $tutor = $user->tutor;
            $solicitudes = TutoringRequest::with(['student'])
                ->where('tutor_id', $tutor->id)
                ->orderBy('fecha', 'desc')
                ->get();
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
        $request->validate([
            'estado' => 'required|in:aceptada,rechazada,completada',
            'motivo_rechazo' => 'required_if:estado,rechazada|nullable|string'
        ]);

        $solicitud->update([
            'estado' => $request->estado,
            'motivo_rechazo' => $request->motivo_rechazo,
        ]);

        return redirect()->route('solicitudes.index')->with('success', 'Estado de la tutoría actualizado.');
    }
}