<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'servicio',
        'fecha',
        'hora',
        'estado',
        'user_id',
    ];

    // Relación inversa con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}