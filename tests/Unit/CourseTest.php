<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Course;

class CourseTest extends TestCase
{
    use RefreshDatabase;

    public function test_course_have_a_name()
    {
        $courseName = 'PHP';
        $course = factory(Course::class)->create(['name'=>'PHP']);

        $this->assertDatabaseHas('courses', ['name'=>'PHP'] );
        $this->assertEquals($courseName, $course->getName());
    }
}
