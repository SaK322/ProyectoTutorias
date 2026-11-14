<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutoringRequest extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'tutor_id', 'materia', 'fecha', 'hora', 'estado', 'motivo_rechazo'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }
}