<?php

use Illuminate\Database\Seeder;
use App\TempleType;

class TempleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      TempleType::create([
	      'type_name' => 'Khayangan Jagat'
	    ]);
    }
}
