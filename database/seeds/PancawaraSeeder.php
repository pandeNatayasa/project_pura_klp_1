<?php

use Illuminate\Database\Seeder;
use App\Pancawara;

class PancawaraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Pancawara::create([
	      'pancawara_name' => 'Umanis'
	    ]);
    }
}
