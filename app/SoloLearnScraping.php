<?php

namespace App;

use App\WebScraping;
use Goutte\Client;


class SoloLearnScraping implements WebScraping
{
    private $candidate;
    private $client;

    public function __construct(Candidate $candidate)
    {
        $this->candidate = $candidate;
        $this->client = new Client();
    }

    public function getAllCourses($candidate)
    {
        $crawler = $this->client->request('GET', $candidate->sololearn);

        $all_courses = [];

        $crawler->filter('.courseWrapper')
        ->each (function($courseNode) use (&$all_courses) {
            $courseTitle = $courseNode->filter('a[class="course"]')->attr('title');
            $coursePercentage = $courseNode->filter('div[class="chart"]')->attr('data-percent');
            $coursePoints = $courseNode->filter('p')->text();
            array_push($all_courses, [$courseTitle, $coursePercentage, $coursePoints]);
        });

        return $all_courses;

    }

     public function getCourse($targetCourse)
        {
            $allCourses = $this->getAllCourses($this->candidate);
            foreach ($allCourses as $course){
                if ($this->substring_in_array($targetCourse->getName(),$course )){

                    return $course;
                }
            }
            return 'No existe el curso seleccionado';
        }

    private function substring_in_array($courseName, array $courses)
    {
        $courseName = $this->if_course_is_java($courseName);

        foreach ($courses as $course) {
            if (false !== strpos($course, $courseName)) {
                return true;
            }
        }
        return false;
    }

    private function if_course_is_java($courseName)
    {
        if ($courseName == 'Java') {
            return 'Java Tutorial';
        }

        return $courseName;
    }

}
