<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetricaSesion extends Model
{
    //
    use HasFactory;

    protected $table = 'MetricaSesion';
    protected $primaryKey = 'idMetricaSesion';

    protected $fillable = [
        'idSesion', 'momento', 'angulo', 'fuerza', 'temperatura', 'intensidad_fes'
    ];

    public function sesion()
    {
        return $this->belongsTo(Sesion::class, 'idSesion');
    }
}
