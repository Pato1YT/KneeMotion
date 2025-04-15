<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    //
    use HasFactory;

    protected $table = 'Paciente';
    protected $primaryKey = 'idPaciente';

    protected $fillable = [
        'idUsuario', 'nombre', 'correo', 'fecha_nacimiento', 'genero', 'diagnostico'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario');
    }

    public function sesiones()
    {
        return $this->hasMany(Sesion::class, 'idPaciente');
    }

    public function dispositivos()
    {
        return $this->hasMany(Dispositivo::class, 'idPaciente');
    }
}
