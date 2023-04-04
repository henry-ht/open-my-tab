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
                'price' => 770
            ),
            array(
                'category_id'    => 1,
                'name'  => 'taladros',
                'price' => 4500
            ),
            array(
                'category_id'    => 1,
                'name'  => 'sierras',
                'price' => 2700
            ),
            array(
                'category_id'    => 1,
                'name'  => 'alicates',
                'price' => 100
            ),
            array(
                'category_id'    => 1,
                'name'  => 'cinceles',
                'price' => 500
            ),
            array(
                'category_id'    => 2,
                'name'  => 'flexómetro',
                'price' => 300
            ),
            array(
                'category_id'    => 2,
                'name'  => 'micrómetro',
                'price' => 500
            ),
            array(
                'category_id'    => 2,
                'name'  => 'regla',
                'price' => 300
            ),
            array(
                'category_id'    => 2,
                'name'  => 'manómetro',
                'price' => 750
            ),
            array(
                'category_id'    => 3,
                'name'  => 'escáner de diagnóstico',
                'price' => 7000
            ),
            array(
                'category_id'    => 3,
                'name'  => 'diagnóstico inalámbricas',
                'price' => 5500
            ),
            array(
                'category_id'    => 3,
                'name'  => 'medición',
                'price' => 6000
            ),
        ];

        foreach ($datos as $key => $value) {
            Product::updateOrCreate($value);
        }
    }
}
