<?php

use Illuminate\Database\Seeder;

class AddSuperiorIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\Departments::class, 20)->create();
    }
}
