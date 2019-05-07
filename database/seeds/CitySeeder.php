<?php

use Illuminate\Database\Seeder;
use App\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		City::create([
	      'province_id' => '1',
	      'city_name' => 'Denpasar'
	    ]);

		City::create([
	      'province_id' => '1',
	      'city_name' => 'Bangli'
	    ]);	    

	    City::create([
	      'province_id' => '2',
	      'city_name' => 'Surabaya'
	    ]);
    }
}
