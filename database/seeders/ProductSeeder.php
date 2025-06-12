<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Badge;

class ProductSeeder extends Seeder
{
    public function run()
    {

        Product::create([
            'name' => 'Comentarios',
            'description' => 'Compra este producto para poder comentar en las publicaciones.',
            'price_hearts' => 20,
            'stock' => 1,
            'badge_id' => Null,
        ]);
    }
}
