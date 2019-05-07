<?php

use Illuminate\Database\Seeder;
use App\Wuku;

class WukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Wuku::create([
	      'wuku_name' => 'Sinta'
	    ]);
    }
}
