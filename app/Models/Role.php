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
	/*
        $getRoles = [];

        foreach (self::all() as $roles){
            $getRoles[$roles['role']]  =  str_replace('.',' can ',$roles->role);
        }
        return $getRoles;
        */
        
        
            /*
         * This Condation to check if We have a Table call roles or not and that cuz we call this method in AuthServiceProvider
         * And The AuthService Work Before a migration level so we must to do that to ِavoid no table error
         */
        if(!Schema::hasTable('roles')){
          return [];
        }

        return self::all()->reduce(function($carry, $role) {
            $carry[$role->role] = str_replace('.',' can ',$role->role);
            return $carry;
        }, []);

    }


}
