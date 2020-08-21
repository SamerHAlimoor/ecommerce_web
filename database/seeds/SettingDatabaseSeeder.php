<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       Setting::setMany([
            'default_locale'=>'en',
            'default_timezone'=>'Asia/Gaza',
            'reviews_enabled'=>true,
            'auto_approve_reviews'=>true,
            'supported_currencies'=>['USD','JOD','ILS'],
            'store_email'=>'admin@ecmmerce.com',
            'search_engine'=>'mysql',
            'local_shipping_cost'=>0,
           'outer_shipping_cost'=>0,
           'free_shipping_cost'=>0,
            'translatable'=>[
                'store_name'=>'Samer Store',
                'free_shipping_lable'=>'Free Shipping',
                'local_lable'=>'Local Shipping',
                'outer_lable'=>'Outer Shipping',

            ],


        ]);
    }
}
