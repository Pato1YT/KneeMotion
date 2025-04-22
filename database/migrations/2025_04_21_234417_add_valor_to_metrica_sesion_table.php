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
            $table->integer('valor')->nullable(); // Ajusta el tipo de dato si es necesario
        });
    }
    
    public function down()
    {
        Schema::table('MetricaSesion', function (Blueprint $table) {
            $table->dropColumn('valor');
        });
    }
    
};
