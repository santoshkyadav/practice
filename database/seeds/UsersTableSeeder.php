<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'studio_name' => 'Admin Studio',
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'mobile_no' => '8052222355',
            'city' => 'lko',
            'state' => 'U.P',
            'user_type' => '1',
            'isVerified' => '1',
            'password' => bcrypt('admin@123'),
        ]);
    }
}
