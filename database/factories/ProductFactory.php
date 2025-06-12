<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Badge; // Importa Badge para obtener un badge_id válido

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        // Tomamos un badge_id aleatorio de los badges existentes
        $badgeId = Badge::inRandomOrder()->value('id');

        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'price_hearts' => $this->faker->numberBetween(5, 100),
            'stock' => $this->faker->numberBetween(1, 50),
            'badge_id' => $badgeId ?: null,  
        ];
    }
}
