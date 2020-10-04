<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name','platform'];

    public function getName()
    {
        return $this->name;
    }

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class, 'course_promotion', 'course_id', 'promotion_id');
    }

    public function progress()
    {
        return $this->hasOne(Progress::class, 'progress_id');
    }
}
