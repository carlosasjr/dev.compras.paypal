<?php

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Product Name ' . uniqid(date('YmdHis')),
            'description' => 'Descrição do Produto',
            'price' => 10.2,
            'image' => 'filme1.jpg'
        ]);

        Product::create([
            'name' => 'Product Name ' . uniqid(date('YmdHis')),
            'description' => 'Descrição do Produto',
            'price' => 8.0,
            'image' => 'filme2.jpg'
        ]);

        Product::create([
            'name' => 'Product Name ' . uniqid(date('YmdHis')),
            'description' => 'Descrição do Produto',
            'price' => 15.2,
            'image' => 'filme3.jpg'
        ]);

        Product::create([
            'name' => 'Product Name ' . uniqid(date('YmdHis')),
            'description' => 'Descrição do Produto',
            'price' => 10.2,
            'image' => 'filme1.jpg'
        ]);

        Product::create([
            'name' => 'Product Name ' . uniqid(date('YmdHis')),
            'description' => 'Descrição do Produto',
            'price' => 8.0,
            'image' => 'filme2.jpg'
        ]);

        Product::create([
            'name' => 'Product Name ' . uniqid(date('YmdHis')),
            'description' => 'Descrição do Produto',
            'price' => 15.2,
            'image' => 'filme3.jpg'
        ]);

        Product::create([
            'name' => 'Product Name ' . uniqid(date('YmdHis')),
            'description' => 'Descrição do Produto',
            'price' => 10.2,
            'image' => 'filme1.jpg'
        ]);

        Product::create([
            'name' => 'Product Name ' . uniqid(date('YmdHis')),
            'description' => 'Descrição do Produto',
            'price' => 8.0,
            'image' => 'filme2.jpg'
        ]);

        Product::create([
            'name' => 'Product Name ' . uniqid(date('YmdHis')),
            'description' => 'Descrição do Produto',
            'price' => 15.2,
            'image' => 'filme3.jpg'
        ]);


        Product::create([
            'name' => 'Product Name ' . uniqid(date('YmdHis')),
            'description' => 'Descrição do Produto',
            'price' => 10.2,
            'image' => 'filme1.jpg'
        ]);

        Product::create([
            'name' => 'Product Name ' . uniqid(date('YmdHis')),
            'description' => 'Descrição do Produto',
            'price' => 8.0,
            'image' => 'filme2.jpg'
        ]);

        Product::create([
            'name' => 'Product Name ' . uniqid(date('YmdHis')),
            'description' => 'Descrição do Produto',
            'price' => 15.2,
            'image' => 'filme3.jpg'
        ]);


        Product::create([
            'name' => 'Product Name ' . uniqid(date('YmdHis')),
            'description' => 'Descrição do Produto',
            'price' => 10.2,
            'image' => 'filme1.jpg'
        ]);

        Product::create([
            'name' => 'Product Name ' . uniqid(date('YmdHis')),
            'description' => 'Descrição do Produto',
            'price' => 8.0,
            'image' => 'filme2.jpg'
        ]);

        Product::create([
            'name' => 'Product Name ' . uniqid(date('YmdHis')),
            'description' => 'Descrição do Produto',
            'price' => 15.2,
            'image' => 'filme3.jpg'
        ]);




    }
}
