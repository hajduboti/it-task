<?php

use Illuminate\Database\Seeder;

class FlightcasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Flightcase::class, 30)->create();
    }
}
