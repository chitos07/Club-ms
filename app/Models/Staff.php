<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public function branche(): object {
        return $this->belongsTo(Branche::class);
    }

    public function user(): object {
        return $this->belongsTo(User::class);
    }
}
