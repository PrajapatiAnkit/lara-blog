<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::create([
          'username' => 'ankit',
          'password' => bcrypt('12345678'),
          'email' => 'ankit@gmail.com',
          'contact' => '7905266028',
          'profile' => '',
          'user_type' => 1,
          'address' =>''
      ]);
    }
}
