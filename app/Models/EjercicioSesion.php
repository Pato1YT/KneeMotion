<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EjercicioSesion extends Model
{
    //
    use HasFactory;

    protected $table = 'EjercicioSesion';
    protected $primaryKey = 'idEjercicioSesion';

    protected $fillable = [
        'idSesion', 'idEjercicio', 'duracion', 'intensidad'
    ];

    public function sesion()
    {
        return $this->belongsTo(Sesion::class, 'idSesion');
    }

    public function ejercicio()
    {
        return $this->belongsTo(Ejercicio::class, 'idEjercicio');
    }
}
