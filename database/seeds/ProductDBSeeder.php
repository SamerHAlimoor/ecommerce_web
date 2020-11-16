<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductDBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(Product::class,30)->create();
    }
}