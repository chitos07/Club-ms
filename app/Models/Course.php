<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public function session(){
        return $this->hasOne(Session::class);
    }
    public function staff(){
        return $this->belongsTo(Staff::class);
    }
    public function course_template(){
        return $this->belongsTo(CourseTemplate::class);
    }

}
