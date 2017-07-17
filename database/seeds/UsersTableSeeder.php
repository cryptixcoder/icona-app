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
        	'name' => 'Eric',
        	'email' => 'eric@iaconacollision.com',
        	'password' => bcrypt('password'),
        	'user_type' => 'admin'
        ]);

        User::create([
            'name' => 'Joe',
            'email' => 'joe@iaconacollision.com',
            'password' => bcrypt('password'),
            'user_type' => 'admin'
        ]);

        User::create([
            'name' => 'Angel',
            'email' => 'angel@iaconacollision.com',
            'password' => bcrypt('password'),
            'user_type' => 'admin'
        ]);
    }
}
