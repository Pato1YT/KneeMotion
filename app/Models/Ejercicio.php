<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ejercicio extends Model
{
    //
    use HasFactory;

    protected $table = 'Ejercicio';
    protected $primaryKey = 'idEjercicio';

    protected $fillable = [
        'nombre', 'descripcion', 'duracion_predeterminada', 'intensidad_predeterminada', 'aplica_fes'
    ];

    public function ejerciciosSesion()
    {
        return $this->hasMany(EjercicioSesion::class, 'idEjercicio');
    }
}
