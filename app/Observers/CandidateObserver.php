<?php

namespace App\Observers;

use App\Candidate;
use App\CodeAcademyScraping;
use App\Course;
use App\Progress;
use App\SoloLearnScraping;
use Carbon\Carbon;

class CandidateObserver
{
    public function created(Candidate $candidate)
    {
        $scrappy_codeAcademy = new CodeAcademyScraping($candidate);
        $scrappy_soloLearn = new SoloLearnScraping($candidate);
        $courses = $candidate->promotion->courses;

        $percentageSum = 0;
        $lastConnections = [];
        foreach ($courses as $course)
        {
            if ($course->platform == 'codeacademy')
            {
                $progress = Progress::fromCodeAcademy($scrappy_codeAcademy, $course);
            }

            if ($course->platform == 'sololearn') {
                $progress = Progress::fromSoloLearn($scrappy_soloLearn, $course);
            }
            $percentageSum += $progress->percentage;
            array_push($lastConnections, $progress->getLastConnection());
        }

        $average_progress = $this->calculatePercentage($percentageSum, count($courses));

        $lastConnection = $this->findClosestDate($lastConnections);

        Candidate::updateProgress($candidate, $average_progress, $lastConnection);

    }

    private function findClosestDate(array $lastConnections)
    {
        if(empty($lastConnections))
        {
            return Carbon::now();
        }

        foreach ($lastConnections as $date)
        {
            $interval[] = abs(strtotime(Carbon::now()) - strtotime($date));
        }
        asort($interval);
        $closest = key($interval);


        return $lastConnections[$closest];
    }

    private function calculatePercentage(int $percentageSum, int $coursesNumber)
    {
        if($coursesNumber == 0)
        {
            return 0;
        }
        return floor($percentageSum / $coursesNumber);
    }
}
