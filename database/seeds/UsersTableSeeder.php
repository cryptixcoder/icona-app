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
        	'name' => 'Markus Gray',
        	'email' => 'markusmgray@gmail.com',
        	'password' => bcrypt('Markus1990'),
        	'user_type' => 'admin'
        ]);

        User::create([
        	'name' => 'Admin User',
        	'email' => 'example@test.com',
        	'password' => bcrypt('password'),
        	'user_type' => 'admin'
        ]);
    }
}
