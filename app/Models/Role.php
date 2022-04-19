<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory,SoftDeletes;


    protected $guarded = [];

    public function users(): object{
        return $this->belongsToMany(User::class);
    }

    public static function getroles(){

        $getRoles = [];

        foreach (self::all() as $roles){
            $getRoles[$roles['role']]  =  str_replace('.',' can ',$roles->role);
        }
        return $getRoles;
    }


}
