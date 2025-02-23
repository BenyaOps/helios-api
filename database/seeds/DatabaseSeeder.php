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
        factory(App\Model\Ambassador::class, 5)->create();
        factory(App\Model\Departments::class, 20)->create();
    }
}
