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
        //DB::table('users')->truncate();
        $users = [
            ['first_name' => 'SEBASTIAN','middle_name' => '','last_name' => 'argon','email' => 'admin@admin.com','password' => bcrypt('admin@123'), 'user_role'=>'1','created_at' => date("Y-m-d H:i:s")],
           ];
        DB::table('users')->insert($users);
    }
}
