<?php

use Carbon\Carbon;
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
        $this->call(AdminTableSeeder::class);
        DB::table('appversion_settings')->insert([
            'android' => '1.0',
            'ios' => '1.o',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        // $this->call(UsersTableSeeder::class);
    }
}
