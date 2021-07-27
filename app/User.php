<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','blockchain_address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function roles(){

        return $this->belongsToMany('App\Role');
    
    }
    
    public function areas(){

        return $this->hasMany('App\Area');
    
    }

    public function offers(){

        return $this->hasMany('App\Offer');
    
    }

    public function comments(){

        return $this->hasMany('App\Comment');
    
    }

    public function documents(){

        return $this->hasMany('App\Document');
    
    }
    public function blockchains(){

        return $this->hasMany('App\Blockchain');
    
    }


    public function hasAnyRoles($roles){

        if ($this-> roles()->whereIn('name',$roles)->first()){
            return true;
        }
        return false;
    }
    
 
    public function hasRole($role){
    if ($this-> roles()->where('name',$role)->first()){
        return true;
    }
    return false;
}  


}
