<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = ['name','course_id'];

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_promotion', 'promotion_id', 'course_id');
    }

}

