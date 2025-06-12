<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Badge;
use App\Models\Product;

class BadgeSeeder extends Seeder
{
    public function run()
    {
        $badges = [
            ['name' => 'Amable', 'icon' => '😊', 'description' => 'Siempre responde con cortesía'],
            ['name' => 'Respetuoso', 'icon' => '🙇', 'description' => 'Trata a todos con respeto'],
            ['name' => 'Participativo', 'icon' => '💬', 'description' => 'Comenta frecuentemente'],
            ['name' => 'Creativo', 'icon' => '🎨', 'description' => 'Publica contenido original'],
            ['name' => 'Ayudador', 'icon' => '🤝', 'description' => 'Responde preguntas de otros'],
            ['name' => 'Motivador', 'icon' => '🔥', 'description' => 'Anima a otros usuarios'],
            ['name' => 'Organizado', 'icon' => '📅', 'description' => 'Usa etiquetas y categorías'],
            ['name' => 'Curioso', 'icon' => '🔍', 'description' => 'Hace preguntas inteligentes'],
            ['name' => 'Confiable', 'icon' => '✅', 'description' => 'Siempre sigue las reglas'],
            ['name' => 'Influyente', 'icon' => '🌟', 'description' => 'Tiene muchos seguidores'],
        ];

        foreach ($badges as $badgeData) {
            $badge = Badge::create([
                'name' => $badgeData['name'],
                'icon' => $badgeData['icon'],
                'description' => $badgeData['description'],
            ]);

            Product::create([
                'name' => $badge->name,
                'badge_id' => $badge->id,
                'description' => $badge->description,
                'price_hearts' => rand(50, 2000),
            ]);
        }
    }
}
