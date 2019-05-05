<?php

use Illuminate\Database\Seeder;
use App\Rahinan;

class RahinanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Rahinan::create([
	      'rahinan_name' => 'Purnama'
	    ]);
    }
}
