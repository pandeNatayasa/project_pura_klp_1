<?php

use Illuminate\Database\Seeder;
use App\TemplePriest;

class TemplePriestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      TemplePriest::create([
	      'priest_name' => 'Pemangku 1'
	    ]);
    }
}
