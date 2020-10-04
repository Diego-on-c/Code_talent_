<?php

namespace Tests\Feature;

use App\Candidate;
use App\Course;
use App\Promotion;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CandidateObserverTest extends TestCase
{
    use RefreshDatabase;

    public function test_creates_a_progress_from_sololearn()
    {
        $promotion = factory(Promotion::class)->create();
        $courses = factory(Course::class,2)->create(['name'=>'CSS', 'platform' => 'sololearn']);

        Promotion::all()->each(function ($pro) use ($courses)
        {
            $pro->courses()->saveMany($courses);
        });

        factory(Candidate::class)->create(['promotion_id'=>$promotion->id,
            'sololearn' => 'https://www.sololearn.com/Profile/6700255',
            'codeacademy'=>'https://www.codecademy.com/profiles/sergioliveresamor_fullstackphysio']);

        $this->assertDatabaseHas('progress', ['percentage' => 100]);
        $this->assertDatabaseCount('progress', 2);
    }

    public function test_creates_a_progress_from_codeacademy()
    {
        $promotion = factory(Promotion::class)->create();
        $courses = factory(Course::class)->create(['name'=>'CSS', 'platform' => 'codeacademy']);

        Promotion::all()->each(function ($pro) use ($courses)
        {
            $pro->courses()->attach($courses);
        });

        factory(Candidate::class)->create(['promotion_id'=>$promotion->id,
            'sololearn' => 'https://www.sololearn.com/Profile/6700255',
            'codeacademy'=>'https://www.codecademy.com/profiles/sergioliveresamor_fullstackphysio']);

        $this->assertDatabaseHas('progress', ['percentage' => 100]);
        $this->assertDatabaseCount('progress', 1);
    }

    public function test_creates_one_progress_for_each_course()
    {
        $promotion = factory(Promotion::class)->create();
        $courses = factory(Course::class,3)->create(['name'=>'CSS', 'platform'=>'sololearn']);

        Promotion::all()->each(function ($pro) use ($courses)
        {
            $pro->courses()->saveMany($courses);
        });

       factory(Candidate::class)->create(['promotion_id'=>$promotion->id,
            'sololearn' => 'https://www.sololearn.com/Profile/6700255',
            'codeacademy'=>'https://www.codecademy.com/profiles/sergioliveresamor_fullstackphysio']);

       $this->assertDatabaseCount('progress',3);
    }

    public function test_creates_progress_from_soloLearn()
    {
        $promotion = factory(Promotion::class)->create();
        $courses = factory(Course::class,2)->create(['name'=>'PHP', 'platform' => 'sololearn']);

        Promotion::all()->each(function ($pro) use ($courses)
        {
            $pro->courses()->saveMany($courses);
        });

        factory(Candidate::class)->create(['promotion_id'=>$promotion->id,
            'sololearn' => 'https://www.sololearn.com/Profile/6700255',
            'codeacademy'=>'https://www.codecademy.com/profiles/sergioliveresamor_fullstackphysio']);

        $this->assertDatabaseHas('progress', ['percentage' => 100]);
    }

    public function test_inserts_candidate_average_progress_into_candidates_table()
    {
        $promotion = factory(Promotion::class)->create();
        $courses = factory(Course::class,2)->create(['name'=>'CSS', 'platform' => 'sololearn']);

        Promotion::all()->each(function ($pro) use ($courses)
        {
            $pro->courses()->saveMany($courses);
        });

        $candidate = factory(Candidate::class)->create(['promotion_id'=>$promotion->id,
            'sololearn' => 'https://www.sololearn.com/Profile/6700255',
            'codeacademy'=>'https://www.codecademy.com/profiles/sergioliveresamor_fullstackphysio']);


        $percentage = 80.0;

        $last_connection = Carbon::now();
        Candidate::updateProgress($candidate, $percentage, $last_connection);

        $this->assertDatabaseHas('candidates', [
            'percentage' => $percentage,
            'last_connection' => $last_connection
        ]);
    }

}
