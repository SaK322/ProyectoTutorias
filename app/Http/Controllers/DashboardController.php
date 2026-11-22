<?php

namespace App\Http\Controllers;

use App\Models\TutoringRequest;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $datos = [];

        if ($user->role === 'estudiante') {
            $datos['pendientes'] = TutoringRequest::where('student_id', $user->id)->where('estado', 'pendiente')->count();
            $datos['aceptadas'] = TutoringRequest::where('student_id', $user->id)->where('estado', 'aceptada')->count();
            $datos['completadas'] = TutoringRequest::where('student_id', $user->id)->where('estado', 'completada')->count();
            $datos['ultimasTutorias'] = TutoringRequest::with('tutor.user')
                ->where('student_id', $user->id)->orderBy('created_at', 'desc')->take(5)->get();
        } 
        elseif ($user->role === 'tutor') {
            $tutorId = $user->tutor->id;
            $datos['pendientes'] = TutoringRequest::where('tutor_id', $tutorId)->where('estado', 'pendiente')->count();
            $datos['aceptadas'] = TutoringRequest::where('tutor_id', $tutorId)->where('estado', 'aceptada')->count();
            $datos['completadas'] = TutoringRequest::where('tutor_id', $tutorId)->where('estado', 'completada')->count();
            $datos['ultimasTutorias'] = TutoringRequest::with('student')
                ->where('tutor_id', $tutorId)->orderBy('created_at', 'desc')->take(5)->get();
        }
        elseif ($user->role === 'admin') {
            $datos['totalTutores'] = Tutor::count();
            $datos['totalEstudiantes'] = User::where('role', 'estudiante')->count();
            $datos['totalTutorias'] = TutoringRequest::count();
        }

        return view('dashboard', $datos);
    }
}