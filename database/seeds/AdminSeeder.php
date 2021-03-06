<?php

use Illuminate\Database\Seeder;
use App\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Admin::create([
	      'name' => 'admin',
	      'email' => 'admin@gmail.com',
	      'password' => Hash::make('123456'),
          'profille_image' => 'profille_image_admin/admin.png'
	    ]);
    }
}
