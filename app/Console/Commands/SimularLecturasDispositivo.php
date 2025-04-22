<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SimularLecturasDispositivo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'simular:metricas {idSesion} {--cantidad=20}';

    protected $description = 'Genera lecturas simuladas de MetricaSesion para una sesión específica';

    /**
     * The console command description.
     *
     * @var string
     */
    //protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $idSesion = $this->argument('idSesion');
        $cantidad = $this->option('cantidad');

        if (!DB::table('Sesion')->where('idSesion', $idSesion)->exists()) {
            $this->error("La sesión con ID $idSesion no existe.");
            return;
        }

        $inicio = Carbon::now();

        for ($i = 0; $i < $cantidad; $i++) {
            DB::table('MetricaSesion')->insert([
                'idSesion' => $idSesion,
                'momento' => $inicio->copy()->addSeconds($i * 5),
                'angulo' => rand(30, 120),
                'fuerza' => round(rand(50, 100) + rand(0, 99)/100, 2),
                'temperatura' => round(rand(350, 385) / 10, 1),
                'intensidad_fes' => rand(0, 100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->info("✅ $cantidad lecturas generadas para la sesión $idSesion.");
    }
}
