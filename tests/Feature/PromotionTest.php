<?php

namespace Tests\Feature;

use App\Candidate;
use App\Promotion;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function Symfony\Component\String\s;

class PromotionTest extends TestCase
{
   use RefreshDatabase;

    public function test_if_can_see_promotion_name()
    {
        $promotion = factory(Promotion::class)->create();
        $response = $this->get('/promotion/'.$promotion->id);

        $response->assertSee($promotion->name);
    }

    public function test_if_can_see_candidates_from_promotion()
    {
        $promotion = factory(Promotion::class)->create();
        $candidates = factory(Candidate::class,3)->create(['promotion_id'=>$promotion->id]);
        $promotion->setRelation('candidates',$candidates);

        $response = $this->get('/promotion/'.$promotion->id);

        $response->assertSee($candidates->first()->name);
        $response->assertSee($candidates->last()->name);
        $this->assertNotEquals($candidates->last()->name,$candidates->first()->name);
    }

    public function test_if_promotion_hasnt_any_candidates()
    {
        $promotion = factory(Promotion::class)->create();

        $response = $this->get('/promotion/'.$promotion->id);

        $response->assertSee('No hay registro !!');

    }

}
