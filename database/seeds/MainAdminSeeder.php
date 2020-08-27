<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;

class MainAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Admin::create([
            'name'=>'sameralimoor',
            'email'=>'sameralimoor@gmail.com',
            'password'=>bcrypt('123456'),

        ]);
    }
}
