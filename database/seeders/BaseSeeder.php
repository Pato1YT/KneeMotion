<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class BaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('es_MX');

        $diagnosticos = [
            "Lesión del ligamento cruzado anterior (LCA)",
            "Artrosis de rodilla leve",
            "Postoperatorio de meniscectomía",
            "Condromalacia rotuliana",
            "Rehabilitación post fractura de fémur",
        ];

        // === Usuarios ===
        for ($i = 1; $i <= 5; $i++) {
            DB::table('Usuario')->insert([
                'idUsuario' => $i,
                'nombre' => ($i === 1 ? 'Dr.' : 'Lic.') . ' ' . $faker->firstName . ' ' . $faker->lastName,
                'correo' => "usuario{$i}@kneemotion.com",
                'contrasena' => Hash::make('123456'),
                'rol' => $i === 1 ? 'admin' : 'fisioterapeuta',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // === Pacientes ===
        for ($i = 1; $i <= 5; $i++) {
            DB::table('Paciente')->insert([
                'idPaciente' => $i,
                'idUsuario' => rand(2, 5),
                'nombre' => $faker->firstName . ' ' . $faker->lastName,
                'correo' => "paciente{$i}@ejemplo.com",
                'fecha_nacimiento' => $faker->date('Y-m-d', '-18 years'),
                'genero' => $faker->randomElement(['masculino', 'femenino']),
                'diagnostico' => $faker->randomElement($diagnosticos),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // === Dispositivos ===
        for ($i = 1; $i <= 5; $i++) {
            DB::table('Dispositivo')->insert([
                'idDispositivo' => $i,
                'numero_serie' => "KM2024-" . str_pad($i, 3, '0', STR_PAD_LEFT),
                'modelo' => 'CPM-KM2024',
                'version_firmware' => '1.0.' . rand(1, 5),
                'estado' => $faker->randomElement(['activo', 'mantenimiento', 'inactivo']),
                'idPaciente' => $i,
                'ultima_sincronizacion' => now()->subMinutes(rand(1, 60)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // === Ejercicios ===
        for ($i = 1; $i <= 5; $i++) {
            DB::table('Ejercicio')->insert([
                'idEjercicio' => $i,
                'nombre' => "Programa $i",
                'descripcion' => "Flexión progresiva nivel $i",
                'duracion_predeterminada' => rand(5, 15),
                'intensidad_predeterminada' => rand(30, 70),
                'aplica_fes' => $faker->boolean,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // === Sesiones y EjercicioSesion ===
        for ($i = 1; $i <= 5; $i++) {
            $inicio = now()->subDays($i);
            $fin = (clone $inicio)->addMinutes(rand(20, 40));

            DB::table('Sesion')->insert([
                'idSesion' => $i,
                'idPaciente' => $i,
                'idDispositivo' => $i,
                'inicio' => $inicio,
                'fin' => $fin,
                'nivel_dolor' => rand(0, 10),
                'notas' => "Sesión sin complicaciones. Paciente toleró bien el ejercicio.",
                'created_at' => $inicio,
                'updated_at' => $fin,
            ]);

            DB::table('EjercicioSesion')->insert([
                'idEjercicioSesion' => $i,
                'idSesion' => $i,
                'idEjercicio' => $i,
                'duracion' => rand(5, 15),
                'intensidad' => rand(30, 70),
                'created_at' => $fin,
                'updated_at' => $fin,
            ]);
        }
    }
}
