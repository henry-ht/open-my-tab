<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            array(
                'category_id'    => 1,
                'name'  => 'destornilladores',
            ),
            array(
                'category_id'    => 1,
                'name'  => 'taladros',
            ),
            array(
                'category_id'    => 1,
                'name'  => 'sierras',
            ),
            array(
                'category_id'    => 1,
                'name'  => 'alicates',
            ),
            array(
                'category_id'    => 1,
                'name'  => 'cinceles',
            ),
            array(
                'category_id'    => 2,
                'name'  => 'flexómetro',
            ),
            array(
                'category_id'    => 2,
                'name'  => 'micrómetro',
            ),
            array(
                'category_id'    => 2,
                'name'  => 'regla',
            ),
            array(
                'category_id'    => 2,
                'name'  => 'manómetro',
            ),
            array(
                'category_id'    => 3,
                'name'  => 'escáner de diagnóstico',
            ),
            array(
                'category_id'    => 3,
                'name'  => 'herramientas de diagnóstico inalámbricas',
            ),
            array(
                'category_id'    => 3,
                'name'  => 'herramientas de medición',
            ),
        ];

        foreach ($datos as $key => $value) {
            Product::updateOrCreate([
                'name' => $value['name']
            ]);
        }
    }
}
