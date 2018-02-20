<?php

use Illuminate\Database\Seeder;
use App\fake_data;

class fake_dataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 1000; $i++) {
            $fakes = factory(fake_data::class, 110)->create();
        }
    }
}
