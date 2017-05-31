<?php

use Illuminate\Database\Seeder;

class SpecificationSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'Мощность', 'value_text' => 'КВт', 'value_number' => 1000,],

        ];

        foreach ($items as $item) {
            \App\Specification::create($item);
        }
    }
}
