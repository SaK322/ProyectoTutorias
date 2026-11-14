<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TutorController extends Controller
{
    public function index()
    {
        $tutores = Tutor::with('user')->get();
        return view('tutores.index', compact('tutores'));
    }

    public function create()
    {
        return view('tutores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'especialidad' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password123'),
            'role' => 'tutor',
        ]);

        $user->tutor()->create([
            'especialidad' => $request->especialidad,
            'descripcion' => $request->descripcion,
            'activo' => true,
        ]);

        return redirect()->route('tutores.index')->with('success', 'Tutor registrado exitosamente.');
    }

    public function show(Tutor $tutor)
    {
        return view('tutores.show', compact('tutor'));
    }

    public function edit(Tutor $tutor)
    {
        return view('tutores.edit', compact('tutor'));
    }

    public function update(Request $request, Tutor $tutor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'activo' => 'boolean',
        ]);

        $tutor->user->update(['name' => $request->name]);
        $tutor->update([
            'especialidad' => $request->especialidad,
            'descripcion' => $request->descripcion,
            'activo' => $request->has('activo'),
        ]);

        return redirect()->route('tutores.index')->with('success', 'Tutor actualizado correctamente.');
    }

    public function destroy(Tutor $tutor)
    {
        $tutor->user->delete();
        return redirect()->route('tutores.index')->with('success', 'Tutor eliminado del sistema.');
    }
}