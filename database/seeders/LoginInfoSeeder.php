<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoginInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('login_infos')->insert(
            [
                'user_id' => 'test@test.com',
                'staff_password' => 'password123',
                'modified_date' => '2023-07-20',
                'created_id' => '1',
                'modified_id' => '1',
            ],
        );
        DB::table('login_infos')->insert(
            [
                'user_id' => 'sample@sample.com',
                'staff_password' =>'password123',
                'modified_date' => '2023-07-27',
                'created_id' => '2',
                'modified_id' => '2',
            ],
        );
    }
}
