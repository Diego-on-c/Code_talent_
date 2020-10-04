<?php

namespace Tests\Unit;

use App\Candidate;
use App\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\SoloLearnScraping;

class SoloLearnScrapingTest extends TestCase
{
    use RefreshDatabase;

    private $scrappedCourses;
    private $scrapy;

    public function setUp() :void
    {
        parent::setUp();
        $this->scrapy = $this->partialMock(SoloLearnScraping::class, function ($mock) {
            $allCourses = include 'tests/Unit/Mock_CoursesSoloLearn.php';
            $mock->shouldReceive('getAllCourses')->andReturns($allCourses);
        });

        $this->scrappedCourses = $this->scrapy->getAllCourses('');
    }

    public function test_get_about_course( )
    {
        $targetCourse = factory(Course::class)->create(['name'=>'PHP']);;
        $php_course = $this->scrapy->getCourse($targetCourse);

        $this->assertContains('PHP Tutorial',$php_course);
        $this->assertContains('100',$php_course);
        $this->assertContains('260 XP',$php_course);
    }

    public function test_if_dont_exist_this_course()
    {
        $targetCourse = factory(Course::class)->create(['name'=>'Ruby']);;

        $ruby_course = $this->scrapy->getCourse($targetCourse);

        $this->assertEquals('No existe el curso seleccionado',$ruby_course);
    }

     public function test_if_progress_is_equal_to_zero()
    {
        $targetCourse = factory(Course::class)->create(['name'=>'Java']);
        $java_course = $this->scrapy->getCourse($targetCourse);

        $this->assertContains('0',$java_course);
    }

    public function test_if_is_java_or_javascript()
    {
        $targetCourse = factory(Course::class)->create(['name'=>'Java']);
        $java_course = $this->scrapy->getCourse($targetCourse);

        $this->assertNotEquals('JavaScript Tutorial',$java_course[0]);
        $this->assertContains('Java Tutorial',$java_course);
    }

}
