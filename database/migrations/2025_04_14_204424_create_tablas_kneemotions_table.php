<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Usuario', function (Blueprint $table) {
            $table->increments('idUsuario')->unsigned();
            $table->string('nombre', 100);
            $table->string('correo', 100)->unique();
            $table->string('contrasena', 100);
            $table->enum('rol', ['admin', 'fisioterapeuta'])->default('fisioterapeuta');
            $table->timestamps();
        });

        Schema::create('Paciente', function (Blueprint $table) {
            $table->increments('idPaciente')->unsigned();
            $table->unsignedInteger('idUsuario');
            $table->string('nombre', 100);
            $table->string('correo', 100)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->enum('genero', ['masculino', 'femenino', 'otro'])->nullable();
            $table->text('diagnostico')->nullable();
            $table->timestamps();
            $table->foreign('idUsuario')->references('idUsuario')->on('Usuario')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('Dispositivo', function (Blueprint $table) {
            $table->increments('idDispositivo')->unsigned();
            $table->string('numero_serie', 100)->unique();
            $table->string('modelo', 100)->nullable();
            $table->string('version_firmware', 100)->nullable();
            $table->enum('estado', ['activo', 'mantenimiento', 'inactivo'])->default('activo');
            $table->unsignedInteger('idPaciente')->nullable();
            $table->timestamp('ultima_sincronizacion')->nullable();
            $table->timestamps();
            $table->foreign('idPaciente')->references('idPaciente')->on('Paciente')
                ->onUpdate('cascade')->onDelete('set null');
        });

        Schema::create('Sesion', function (Blueprint $table) {
            $table->increments('idSesion')->unsigned();
            $table->unsignedInteger('idPaciente');
            $table->unsignedInteger('idDispositivo');
            $table->timestamp('inicio');
            $table->timestamp('fin')->nullable();
            $table->unsignedTinyInteger('nivel_dolor')->nullable();
            $table->text('notas')->nullable();
            $table->timestamps();
            $table->foreign('idPaciente')->references('idPaciente')->on('Paciente')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idDispositivo')->references('idDispositivo')->on('Dispositivo')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('MetricaSesion', function (Blueprint $table) {
            $table->increments('idMetricaSesion')->unsigned();
            $table->unsignedInteger('idSesion');
            $table->timestamp('momento');
            $table->float('angulo')->nullable();
            $table->float('fuerza')->nullable();
            $table->float('temperatura')->nullable();
            $table->unsignedTinyInteger('intensidad_fes')->nullable();
            $table->timestamps();
            $table->foreign('idSesion')->references('idSesion')->on('Sesion')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('Ejercicio', function (Blueprint $table) {
            $table->increments('idEjercicio')->unsigned();
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->integer('duracion_predeterminada')->nullable();
            $table->integer('intensidad_predeterminada')->nullable();
            $table->timestamps();
        });

        Schema::create('EjercicioSesion', function (Blueprint $table) {
            $table->increments('idEjercicioSesion')->unsigned();
            $table->unsignedInteger('idSesion');
            $table->unsignedInteger('idEjercicio');
            $table->integer('duracion')->nullable();
            $table->integer('intensidad')->nullable();
            $table->timestamps();
            $table->foreign('idSesion')->references('idSesion')->on('Sesion')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idEjercicio')->references('idEjercicio')->on('Ejercicio')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('EjercicioSesion');
        Schema::dropIfExists('Ejercicio');
        Schema::dropIfExists('MetricaSesion');
        Schema::dropIfExists('Sesion');
        Schema::dropIfExists('Dispositivo');
        Schema::dropIfExists('Paciente');
        Schema::dropIfExists('Usuario');
    }
};
