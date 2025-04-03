<?php

namespace Database\Seeders;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                "title" => "Terapia Individual
",
                "description" => "A veces, la vida nos pone obstáculos que parecen imposibles de superar. En nuestra consulta, los psicólogos trabajan contigo para ayudarte a gestionar la ansiedad, la depresión, el estrés y otros desafíos emocionales. A través de sesiones personalizadas, crean un espacio seguro donde puedes hablar sin miedo, encontrar nuevas herramientas para afrontar tus preocupaciones y empezar a sentirte mejor contigo mismo.

No importa si es la primera vez que buscas ayuda o si ya has pasado por terapia antes, aquí te acompañan en cada paso de tu proceso, con empatía y sin juicios.

",
                "image" => "images/s3.jpg"
            ],
            [
                "title" => "Terapia de Pareja",
                "description" => "Las relaciones no siempre son fáciles, y es normal que en algún momento surjan conflictos, falta de comunicación o desgaste emocional. Sus especialistas en terapia de pareja ayudan a reconstruir la confianza, mejorar la comunicación y fortalecer el vínculo entre ambos.

No se trata de buscar culpables, sino de encontrar soluciones. Ya sea que estén pasando por una crisis o simplemente quieran mejorar su relación, en terapia podrán expresar lo que sienten, entenderse mejor y trabajar juntos para lograr una convivencia más armoniosa.",
                "image" => "images/s2.jpg"
            ],
            [
                "title" => "Terapia para Niños y Adolescentes",
                "description" => "Los niños y adolescentes también enfrentan sus propios retos emocionales: problemas de autoestima, dificultades en la escuela, cambios de humor o situaciones familiares complicadas. A través de técnicas adaptadas a su edad, los psicólogos crean un espacio en el que se sientan comprendidos y seguros para expresarse.
",
                "image" => "images/s1.jpg"
            ],

        ];

        foreach ($services as $service) {
            Service::create([
                "title" => $service['title'],
                "description" => $service['description'],
                "image" => $service['image'],
            ]);
        }
    }
}
