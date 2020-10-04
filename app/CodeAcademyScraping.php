<?php

namespace App;

use App\WebScraping;
use Goutte\Client;

class CodeAcademyScraping implements WebScraping
{
    private Candidate $candidate;

    public function __construct(Candidate $candidate)
    {
        $this->candidate = $candidate;
    }

    public function getAllCourses()
    {
        $client = new Client();
        $crawler = $client->request('GET', $this->candidate->codeacademy);
        $all_courses = [];

        $crawler->filter('.container__25St-wPttEa00dbsIQGsRH')
        ->each(function ($courseNode) use (&$all_courses)
        {
            $courseTitle = $courseNode->filter('.title__YKjOCEmg015vuLRonUC5l')->text();

            array_push($all_courses, $courseTitle);
        });

        return $all_courses;
    }
    public function getCourse(Course $course)
    {
        $all_courses = $this->getAllCourses();

        if($this->substring_in_array($course->getName(),$all_courses))
            {
                return $course;
            }

        return 'No existe el curso seleccionado';
    }

    private function substring_in_array($courseName, array $courses)
    {
        foreach ($courses as $course) {
            if (false !== strpos($course, $courseName)) {
                return true;
            }
        }
        return false;
    }

    public function lastConnection()
    {
        $client = new Client();
        $crawler = $client->request('GET', $this->candidate->codeacademy);

        $lastCoded = $crawler->filter('.label__2YO_cDf1Lu9PDDsn62kz6L > span')->text();

        return $lastCoded;
    }



}
