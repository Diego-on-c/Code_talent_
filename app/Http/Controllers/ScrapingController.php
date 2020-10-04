<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use App\WebScrapping;

class ScrapingController extends Controller
{
    public function getSoloLearnData()
    {
        $courseData = [];
        $webScrapper = new WebScrapping();
        $crawler = $webScrapper->scrap('https://www.sololearn.com/Profile/6700255');
        
        $course = $crawler->filter('.courseWrapper')->each(function ($courseNode) use (&$courseData)
        {   
            $courseTitle = $courseNode->filter('a[class="course"]')->attr('title'); #dtrin
            $coursePercentage = $courseNode->filter('div[class="chart"]')->attr('data-percent');#string
            $courseExperience = $courseNode->filter('p')->text();#string
            array_push($courseData, [$courseTitle, $coursePercentage, $courseExperience]);
        }); 
    
        return $courseData;
    }
}
