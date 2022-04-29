<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(UserRolesSeeder::class);
        // \App\Models\company::factory(10)->create();

        DB::table('companies')->insert([
            'company_name' => 'LBU Forensic Investigators',
            'contact_number' => '01132874325',
            'email' => 'lbu_forensic_investigators@gmail.com',
            'company_description' => 'A digital forensic company based out of Leeds Beckett University.',
            'address_line_1' => 'Headingley Campus, City, Leeds',
            'address_line_2' => 'LS16 5LF
            ',
        ]);
        
        DB::table('users')->insert([
            'name' => 'Thomas Thackeray',
            'email' => 'thomasthackeray0@gmail.com',
            'password' => '$2y$10$dOyVRUvI3mdHL9HB3d60Qe62J/iTaOGo1I3Qb3TKiN41XGKtv3t5S',
            'contact_number' => '01132874448',
            'username' => 'Thomas',
            'company_id' => '1',
            'user_role_id' => '1',
            'active' => '0',
        ]);

        

        // \App\Models\User::factory(10)->create();
        // \App\Models\user_roles::factory(1)->create();

        // These factorys are for debugging and testing
        
        // \App\Models\fornsic_cases::factory(30)->create();
        // \App\Models\fornsic_notes::factory(30)->create();

    }
}
