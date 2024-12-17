<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Update 'role' column for id_userx = 1
        DB::table('user_list')->where('id_userx', 1)->update(['role' => 'admin']);
    }
}
