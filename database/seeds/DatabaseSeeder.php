<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(AdminSeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(PancawaraSeeder::class);
        $this->call(RahinanSeeder::class);
        $this->call(SaptawaraSeeder::class);
        $this->call(SasihSeeder::class);
        $this->call(SubDistrictSeeder::class);
        $this->call(TempleTypeSeeder::class);
        $this->call(WukuSeeder::class);
        // $this->call(UsersTableSeeder::class);
    }
}
