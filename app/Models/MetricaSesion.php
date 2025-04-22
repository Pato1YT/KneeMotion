<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetricaSesion extends Model
{
    use HasFactory;

    protected $table = 'MetricaSesion';
    protected $primaryKey = 'idMetricaSesion';

    protected $fillable = [
        'idSesion',
        'momento',
        'angulo',
        'fuerza',
        'temperatura',
        'intensidad_fes',
        'metrica',
        'valor',
        'unidad',
        'created_at',
        'updated_at'
    ];

    public function sesion()
    {
        return $this->belongsTo(Sesion::class, 'idSesion');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->momento)) {
                $model->momento = now();
            }
        });
    }
}
