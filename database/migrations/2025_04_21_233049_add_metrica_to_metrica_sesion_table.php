<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('MetricaSesion', function (Blueprint $table) {
            $table->string('metrica')->nullable(); // Ajusta el tipo de dato según tu necesidad
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('MetricaSesion', function (Blueprint $table) {
            $table->dropColumn('metrica');
        });
    }
};
