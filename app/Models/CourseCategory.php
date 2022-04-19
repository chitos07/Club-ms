<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseCategory extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded=[];
    protected $table = 'course_categories';

    public function club(): object{
        return $this->belongsTo(Club::class);
    }
}
