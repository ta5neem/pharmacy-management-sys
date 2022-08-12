<?php

//namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BranchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	factory(App\Location::class, 5)->create();
        factory(App\TypeBranch::class, 5)->create();
        factory(App\Branch::class, 5)->create();
        factory(App\User::class, 5)->create();
    }
}
