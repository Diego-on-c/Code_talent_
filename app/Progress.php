<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Progress extends Model
{
    protected $table = 'progress';

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    private function __construct()
    {

    }

    public static function fromSoloLearn(SoloLearnScraping $scrappy_soloLearn, Course $course)
    {
        $scrappedCourse = $scrappy_soloLearn->getCourse($course);
        $course_percentage = $scrappedCourse[1];

        $progress = new Progress();
        $updated_at = $progress->getAttribute('updated_at');

        $progress->setPercentage($course_percentage);
        $progress->setLastConnection($updated_at);
        $progress->setCourseId($course->id);
        $progress->save();

        return $progress;
    }

    public static function fromCodeAcademy(CodeAcademyScraping $scrappy_codeAcademy, Course $course)
    {
        $progress = new Progress();
        $scrapped_course = $scrappy_codeAcademy->getCourse($course);
        $lastConnection = $scrappy_codeAcademy->lastConnection();
        $percentage = $progress->calculatePercentage($scrapped_course);

        $progress->setLastConnection($lastConnection);
        $progress->setPercentage($percentage);
        $progress->setCourseId($course->id);
        $progress->save();

        return $progress;
    }

    public function getPercentage()
    {
        return $this->percentage;
    }

    private function setPercentage($percentage)
    {
        $this->percentage = intval($percentage);
    }

    public function getLastConnection()
    {
        return $this->last_connection;
    }

    public function setLastConnection($last_connection)
    {
        $formattedDate = $this->checkFormat($last_connection);
        $this->last_connection = $formattedDate;
    }

    private function setCourseId(int $id)
    {
        $this->course_id = $id;
    }

    private function calculatePercentage($scrapped_course): int
    {
        if ($scrapped_course === 'No existe el curso seleccionado')
        {
            return 0;
        }
        return 100;
    }

    private function checkFormat($last_connection): Carbon
    {
        if (!$last_connection)
        {
            return Carbon::now();
        }

        if (is_string($last_connection))
        {
            return Carbon::now()->sub($last_connection);
        }

        return $last_connection;
    }

}
