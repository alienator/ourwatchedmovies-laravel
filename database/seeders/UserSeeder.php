<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'test',
            'email' => 'aa@aa.com',
            'password' => 'A665A45920422F9D417eE4867EFDC4FB8A04A1F3FFF1FA07E998E86F7F7A27AE3' // sha256(123)
        ]);

    }
}
