<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseTemplate extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public function branche(): object{
        return $this->belongsTo(Branche::class);
    }
    public function course_category(): object{
        return $this->belongsTo(CourseCategory::class);
    }
    public function cancellation_policy(): object{
        return $this->belongsTo(CancellationPolicy::class);
    }
}
