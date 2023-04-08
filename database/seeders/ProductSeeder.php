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
                'price' => 67000
            ),
            array(
                'category_id'    => 1,
                'name'  => 'taladros',
                'price' => 65000
            ),
            array(
                'category_id'    => 1,
                'name'  => 'sierras',
                'price' => 87000
            ),
            array(
                'category_id'    => 1,
                'name'  => 'alicates',
                'price' => 80000
            ),
            array(
                'category_id'    => 1,
                'name'  => 'cinceles',
                'price' => 84000
            ),
            array(
                'category_id'    => 2,
                'name'  => 'flexómetro',
                'price' => 66000
            ),
            array(
                'category_id'    => 2,
                'name'  => 'micrómetro',
                'price' => 71000
            ),
            array(
                'category_id'    => 2,
                'name'  => 'regla',
                'price' => 80000
            ),
            array(
                'category_id'    => 2,
                'name'  => 'manómetro',
                'price' => 80000
            ),
            array(
                'category_id'    => 3,
                'name'  => 'escáner de diagnóstico',
                'price' => 84000
            ),
            array(
                'category_id'    => 3,
                'name'  => 'diagnóstico inalámbricas',
                'price' => 84000
            ),
            array(
                'category_id'    => 3,
                'name'  => 'medición',
                'price' => 84000
            ),
        ];

        foreach ($datos as $key => $value) {
            Product::updateOrCreate($value);
        }
    }
}
