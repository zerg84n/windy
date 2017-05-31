<?php

use Illuminate\Database\Seeder;

class ProductSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 2, 'title' => 'Сушилка для рук х-1', 'description' => 'Дорогая сушилка', 'price_original' => '2000.00', 'price_sale' => '1000.00', 'category_id' => 1, 'status' => null, 'amount' => 3, 'popular' => 0,],

        ];

        foreach ($items as $item) {
            \App\Product::create($item);
        }
    }
}
