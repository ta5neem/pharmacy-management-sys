<?php

//namespace Database\Seeders;

use Illuminate\Database\Seeder;


class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	factory(App\Models\Warehouse::class, 5)->create();
        factory(App\Models\BuyOrder::class, 5)->create();
        factory(App\Models\BuyProduct::class, 10)->create();
        factory(App\Models\BuyBill::class, 5)->create();
        factory(App\Models\BuyBillProduct::class, 10)->create();
        factory(App\Models\ProductPlace::class, 5)->create();
        factory(App\Models\BookIn::class, 10)->create();


    }
}
