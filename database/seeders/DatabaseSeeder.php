<?php

namespace Database\Seeders;

use App\Models\Rol;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Hash;
use Illuminate\Database\Seeder;
use Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = ["Admin","Psicologo", "Cliente"];
        foreach ($roles as $rol) {
            $userRol = Rol::create([
                'rol' => $rol
            ]);
            User::create([
                'name' => "$rol nombre",
                'lastname' => "$rol apellidos",
                'email' => Str::lower("$rol@test.com"),
                'rol_id' => $userRol->id,
                'phone' => "666551144",
                'skills' => $rol == "Psicologo" ? "Licenciado en Psicología,Especialista en Psicología Clínica,Máster en Psicología General Sanitaria,Máster en Patologías del Habla
,Máster en estudio e intervención de violencia en la familia y pareja" : null,
                'password' => Hash::make("password"),
            ]);
        }
        $this->call(ServiceSeeder::class);
        $this->call(HourRangeSeeder::class);
        $this->call(WeekDaySeeder::class);
    }


}
