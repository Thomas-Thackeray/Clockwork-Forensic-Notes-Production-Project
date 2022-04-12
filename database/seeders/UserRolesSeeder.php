<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->insert([
            'role_name' => 'Company Manager',
            'role_type' => 'super_admin',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => date("Y-m-d H:i:s"),
             
        ]);
        DB::table('user_roles')->insert([
            'role_name' => 'Lead Investigator',
            'role_type' => 'admin',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => date("Y-m-d H:i:s"),
             
        ]);
        DB::table('user_roles')->insert([
            'role_name' => 'Investigator',
            'role_type' => 'basic_user',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => date("Y-m-d H:i:s"),
             
        ]);
        DB::table('user_roles')->insert([
            'role_name' => 'Law Enforcement',
            'role_type' => 'Law',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => date("Y-m-d H:i:s"),
             
        ]);
    }
}
