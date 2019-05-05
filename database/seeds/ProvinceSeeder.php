<?php

use Illuminate\Database\Seeder;
use App\Province;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Province::create([
	      'province_name' => 'Bali'
	    ]);

	    Province::create([
	      'province_name' => 'Jawa Timur'
	    ]);
    }
}
