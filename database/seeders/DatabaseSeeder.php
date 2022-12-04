<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();

        $interventionClassification  = new \Database\Seeders\InterventionClassificationSeeder();
        $plantClassification  = new \Database\Seeders\PlantClassificationSeeder();
        $bonsaiStyle  = new \Database\Seeders\BonsaiStyleSeeder();
        $interventionClassification->run();
        $plantClassification->run();
        $bonsaiStyle->run();
    }
}
