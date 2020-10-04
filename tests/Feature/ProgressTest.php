<?php

namespace Tests\Feature;

use App\Candidate;
use App\CodeAcademyScraping;
use App\Course;
use App\Progress;
use App\SoloLearnScraping;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Date;
use Tests\TestCase;


class ProgressTest extends TestCase
{
    use RefreshDatabase;

    private $scrappy_soloLearn;
    private $scrappy_codeAcademy;
    private $php_course;
    private $html_course;

    public function setUp(): void
    {
        parent::setUp();
        $candidate = factory(Candidate::class)->make([
            'sololearn' => 'https://www.sololearn.com/Profile/6700255',
            'codeacademy'=>'https://www.codecademy.com/profiles/sergioliveresamor_fullstackphysio'
        ]);

        $this->scrappy_soloLearn = new SoloLearnScraping($candidate);
        $this->scrappy_codeAcademy = new CodeAcademyScraping($candidate);

        $this->html_course = factory(Course::class)->create(['name'=>'HTML']);;
        $this->php_course = factory(Course::class)->create(['name'=>'PHP']);;
    }

    public function test_if_sololearn_course_has_a_percentage()
    {
        $scrappedCourse = $this->scrappy_soloLearn->getCourse($this->php_course);
        $course_percentage = $scrappedCourse[1];
        $progress = Progress::fromSoloLearn($this->scrappy_soloLearn, $this->php_course);
        $progress_percentage = $progress->getPercentage();

        $this->assertEquals($course_percentage,$progress_percentage);
        $this->assertDatabaseHas('progress', ["percentage" => 100]);
    }

    public function test_if_codeacademy_course_has_a_percentage()
    {
        $course_percentage = 100;
        $progress = Progress::fromCodeAcademy($this->scrappy_codeAcademy, $this->html_course);
        $progress_percentage = $progress->getPercentage();

        $this->assertEquals($course_percentage,$progress_percentage);
        $this->assertDatabaseHas('progress', ["percentage" => $course_percentage]);
    }

    public function test_convert_percentage_string_to_integer()
    {
        $progress_percentage = Progress::fromSoloLearn($this->scrappy_soloLearn, $this->php_course)->getPercentage();

        $this->assertIsInt($progress_percentage);
    }

    public function test_get_percentage_from_sololearn_course()
    {
        $mock_courses = include 'tests/Unit/Mock_CoursesSoloLearn.php';
        $php_course = $mock_courses[4];
        $php_course_percentage = 100;

        $percentage = Progress::fromSoloLearn( $this->scrappy_soloLearn, $this->php_course)->getPercentage();

        $this->assertTrue(in_array($percentage, $php_course));
        $this->assertEquals($percentage, $php_course_percentage);
        $this->assertDatabaseHas('progress', ['percentage'=>100]);
    }

    public function test_get_percentage_from_codeacademy_course_is_one_hundred()
    {
        $percentage = Progress::fromCodeAcademy( $this->scrappy_codeAcademy, $this->html_course)->getPercentage();

        $this->assertEquals(100,$percentage);
    }

    public function test_get_percentage_from_codeacademy_course_is_zero()
    {
        $percentage = Progress::fromCodeAcademy( $this->scrappy_codeAcademy, $this->php_course)->getPercentage();

        $this->assertEquals(0,$percentage);
    }

    public function test_progress_has_last_connection()
    {
        $progress = Progress::fromSoloLearn( $this->scrappy_soloLearn, $this->php_course);
        $progress->setLastConnection(Carbon::now());

        $this->assertNotNull($progress->getLastConnection());
    }

    public function test_last_connection_is_Carbon_object()
    {
        $sololearnProgress = Progress::fromSoloLearn( $this->scrappy_soloLearn, $this->php_course);
        $sololearnProgress->setLastConnection(null);

        $codeacademyProgress = Progress::fromCodeAcademy( $this->scrappy_codeAcademy, $this->php_course);

        $this->assertInstanceOf(Carbon::class, $sololearnProgress->getLastConnection());
        $this->assertInstanceOf(Carbon::class, $codeacademyProgress->getLastConnection());
    }

    public function test_progress_has_a_course_id()
    {
        $sololearnProgress = Progress::fromSoloLearn( $this->scrappy_soloLearn, $this->php_course);
        $sololearnProgress->setLastConnection(null);

        $codeacademyProgress = Progress::fromCodeAcademy( $this->scrappy_codeAcademy, $this->php_course);

        $this->assertNotNull($codeacademyProgress->course_id);
        //$this->assertDatabaseHas('progress', ['course_id' => 1]);
    }
}
