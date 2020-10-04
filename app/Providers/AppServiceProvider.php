<?php

namespace App\Providers;

use App\Candidate;
use App\Observers\CandidateObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }


    public function boot()
    {
        Candidate::observe(CandidateObserver::class);
    }
}
