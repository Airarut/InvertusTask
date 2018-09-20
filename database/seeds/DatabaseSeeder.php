<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('states')->insert(['name' => "New"]);
        DB::table('states')->insert(['name' => "To Do"]);
        DB::table('states')->insert(['name' => "In Progress"]);
        DB::table('states')->insert(['name' => "Done"]);
    }
}
