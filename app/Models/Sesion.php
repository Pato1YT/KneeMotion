<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    //
    use HasFactory;

    protected $table = 'Sesion';
    protected $primaryKey = 'idSesion';

    protected $fillable = [
        'idPaciente', 'idDispositivo', 'inicio', 'fin', 'nivel_dolor', 'notas'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'idPaciente');
    }

    public function dispositivo()
    {
        return $this->belongsTo(Dispositivo::class, 'idDispositivo');
    }

    public function metricas()
    {
        return $this->hasMany(MetricaSesion::class, 'idSesion');
    }

    public function ejerciciosSesion()
    {
        return $this->hasMany(EjercicioSesion::class, 'idSesion');
    }
}
