<?php

use Illuminate\Database\Seeder;
use App\Candidate;

class CandidatesSeeder extends Seeder
{

    public function run()
    {
        factory(Candidate::class, 10)->create();
    }
}
