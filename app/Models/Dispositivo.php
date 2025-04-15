<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispositivo extends Model
{
    //
    use HasFactory;

    protected $table = 'Dispositivo';
    protected $primaryKey = 'idDispositivo';

    protected $fillable = [
        'numero_serie', 'modelo', 'version_firmware', 'estado', 'idPaciente', 'ultima_sincronizacion'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'idPaciente');
    }

    public function sesiones()
    {
        return $this->hasMany(Sesion::class, 'idDispositivo');
    }
}
