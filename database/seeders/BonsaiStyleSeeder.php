<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BonsaiStyle;

class BonsaiStyleSeeder extends Seeder
{
    /**
     * Collection of basic bonsai styles.
     * 
     * @var array
     */
    protected $basicBonsaiStyles = array(
        'chokan'     => 'description',
        'moyogi'     => 'description',
        'shakan'     => 'description',
        'ham-kengai' => 'description',
        'kengai'     => 'description'
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (BonsaiStyle::all()->first() == null)
            $this->runBasicSeeding();
    }

    /**
     * Run the basic intervention seed.
     * 
     * @return void
     */
    private function runBasicSeeding()
    {
        foreach ($this->basicBonsaiStyles as $title => $description)
            BonsaiStyle::create([
                'title'       => $title
            ]);
    }
}
