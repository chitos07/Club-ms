<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseElement extends Model
{
    use HasFactory,SoftDeletes;

    protected  $guarded = [];

    public function club(): object{
        return $this->belongsTo(Club::class);
    }

    public function course_template(): object{
        return $this->belongsTo(CourseTemplate::class);
    }
}
