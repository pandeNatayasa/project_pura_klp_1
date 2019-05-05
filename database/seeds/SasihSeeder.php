<?php

use Illuminate\Database\Seeder;
use App\Sasih;

class SasihSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Sasih::create([
	      'sasih_name' => 'Kara'
	    ]);
    }
}
