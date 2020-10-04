<?php

namespace App;

use Goutte\Client;
use PhpParser\Builder\Interface_;

interface WebScraping
{
    public function getCourse(Course $course);

}
