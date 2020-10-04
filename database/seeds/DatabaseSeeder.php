<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call(CourseSeeder::class);
        $this->call(PromotionSeeder::class);
        $this->call(CandidatesSeeder::class);

    }
}
