<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'especialidad', 'descripcion', 'activo'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function availabilities()
    {
        return $this->hasMany(Availability::class);
    }

    public function tutoringRequests()
    {
        return $this->hasMany(TutoringRequest::class);
    }
}