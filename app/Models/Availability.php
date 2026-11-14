<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;

    protected $fillable = ['tutor_id', 'dia', 'hora_inicio', 'hora_fin'];

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }
}