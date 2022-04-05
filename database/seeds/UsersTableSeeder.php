<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'role_id' => 1,
                'name' => 'Admin',
                'email' => 'agrisell2077@gmail.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => '2020-02-09 12:42:53',
                'password' => bcrypt('agrisell'),
                'remember_token' => 'EbrJUMkdZPGKaaZSnJsgooPS1gSl8R2zkX2FBCupEVZ4qnKLvvg3MGAdFROD',
                'settings' => NULL,
                'created_at' => '2020-02-09 12:42:53',
                'updated_at' => '2020-02-11 00:15:23',
            ),
            1 => 
            array (
                'id' => 2,
                'role_id' => 2,
                'name' => 'Agri sell demo customer',
                'email' => 'Customer1@agrisellDemo.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => '2020-02-11 00:16:34',
                'password' => bcrypt('agrisell'),
                'remember_token' => NULL,
                'settings' => '{"locale":"en"}',
                'created_at' => '2020-02-11 00:16:34',
                'updated_at' => '2020-02-19 17:25:45',
            ),
            2 => 
            array (
                'id' => 3,
                'role_id' => 2,
                'name' => 'Apolinario Gabriel',
                'email' => 'gabriel@agrisell.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => '2020-02-11 00:16:34',
                'password' => bcrypt('agrisell'),
                'remember_token' => NULL,
                'settings' => NULL,
                'created_at' => '2020-02-11 00:16:34',
                'updated_at' => '2020-02-11 00:16:34',
            ),
            3 => 
            array (
                'id' => 4,
                'role_id' => 2,
                'name' => 'Anastasio Gomez',           
                'email' => 'gomez@agrisell.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$xJacK/k89sSDbvDvqaMnC.KLEHOZr/YhqQMVSrvrTVhjggQgVhzpq',
                'remember_token' => NULL,
                'settings' => NULL,
                'created_at' => '2020-02-11 00:16:34',
                'updated_at' => '2020-02-11 00:16:34',
            ),
        ));
        
        
    }
}