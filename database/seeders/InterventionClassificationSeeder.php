<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InterventionClassification;

class InterventionClassificationSeeder extends Seeder
{
    /**
     * Collection of basic bonsai interventions.
     * 
     * @var array
     */
    protected $basicInterventions = array(
        'prunning'      => 'description',
        'deep-prunning' => 'description',
        'watering'      => 'description',
        'feeding'       => 'description',
        'root-prunning' => 'description',
        'repoting'      => 'description',
        'wiring'        => 'description',
        'shaping'       => 'description',
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (InterventionClassification::all()->first() == null)
            $this->runBasicSeeding();
    }

    /**
     * Run the basic intervention seed.
     * 
     * @return void
     */
    private function runBasicSeeding()
    {
        foreach ($this->basicInterventions as $title => $description)
            InterventionClassification::create([
                'title' => $title
            ]);
    }
}
