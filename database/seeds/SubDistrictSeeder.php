<?php

use Illuminate\Database\Seeder;
use App\SubDistrict;

class SubDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      SubDistrict::create([
	      'city_id' => '1',
	      'sub_district_name' => 'Denpasar Timur'
	    ]);

			SubDistrict::create([
	      'city_id' => '2',
	      'sub_district_name' => 'Bangli'
	    ]);	    

	    SubDistrict::create([
	      'city_id' => '3',
	      'sub_district_name' => 'Surabaya'
	    ]);
    }
}
