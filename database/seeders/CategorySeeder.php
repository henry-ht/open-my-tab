<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            array(
                'id'    => 1,
                'name'  => 'herramientas manuales',
            ),
            array(
                'id'    => 2,
                'name'  => 'herramientas de medición',
            ),
            array(
                'id'    => 3,
                'name'  => 'herramientas de diagnóstico',
            ),
        ];

        foreach ($datos as $key => $value) {
            Category::updateOrCreate([
                'name' => $value['name']
            ]);
        }
    }
}
