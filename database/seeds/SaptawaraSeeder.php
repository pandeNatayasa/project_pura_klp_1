<?php

use Illuminate\Database\Seeder;
use App\Saptawara;

class SaptawaraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Saptawara::create([
	      'saptawara_name' => 'Redite'
	    ]);

	    Saptawara::create([
	      'saptawara_name' => 'Soma'
	    ]);
    }
}
