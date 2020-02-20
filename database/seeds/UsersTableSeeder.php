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
          [
              'name' => 'Ankit kumar',
              'username' => 'ankit',
              'password' => bcrypt('12345678'),
              'email' => 'ankit@gmail.com',
              'contact' => '7905266028',
              'profile' => '',
              'user_type' => 1,
          ],
          [
              'name' => 'Pravin',
              'username' => 'pravin',
              'password' => bcrypt('12345678'),
              'email' => 'pravin@gmail.com',
              'contact' => '7905266028',
              'profile' => '',
              'user_type' => 1,
          ]
      ]);
    }
}
