<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMetricaSesionTable extends Migration
{
    public function up()
    {
        Schema::table('MetricaSesion', function (Blueprint $table) {
            // 1️⃣ Eliminar la clave foránea antes de modificar la columna
            $table->dropForeign(['idSesion']);

            // 2️⃣ Modificar la columna asegurando que sea UNSIGNED y tenga un valor predeterminado
            $table->unsignedInteger('idSesion')->default(0)->change();

            // 3️⃣ Volver a agregar la clave foránea después de la modificación
            $table->foreign('idSesion')->references('idSesion')->on('sesion')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('MetricaSesion', function (Blueprint $table) {
            // Revertir cambios
            $table->dropForeign(['idSesion']);
            $table->integer('idSesion')->nullable(false)->change();
            $table->foreign('idSesion')->references('idSesion')->on('sesion')->onDelete('cascade')->onUpdate('cascade');
        });
    }
}
