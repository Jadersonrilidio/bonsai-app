<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PlantClassification;

class PlantClassificationSeeder extends Seeder
{
    /**
     * Collection of basic plants classification.
     * 
     * @var array
     */
    protected $basicPlantsClassification = array(
        'bonsai'     => 'description',
        'pre-bonsai' => 'description',
        'seedling'   => 'description',
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (plantClassification::all()->first() == null)
            $this->runBasicSeeding();
    }

    /**
     * Run the basic intervention seed.
     * 
     * @return void
     */
    private function runBasicSeeding()
    {
        foreach ($this->basicPlantsClassification as $title => $description)
            PlantClassification::create([
                'title' => $title
            ]);
    }
}
