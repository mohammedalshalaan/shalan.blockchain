<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [ // this protects the below variables, so the values of these variables will not be able to change or fill in by the malicious http requests that could be occurred by the attacker. 
        'title','content','image','hash','value','owner','hex_data','hex_id','hash_picture','certificate_id','state','valid'
    ];
    public function user(){// the relation between the User model and the Offer model is 1 to many. So, each user can create many offers.

        return $this->belongsTo('App\User');
    }

    public function area(){ //the relation between the Area model and the Offer model is 1 to many. So, each Area contains many offers.

        return $this->belongsTo('App\Area');
    }
    
    public function comments(){ //the relation between the Comment model and the Offer model is many to 1. So, many comments are included by a one offer.


    return $this->hasMany('App\Comment');
    }

    public function documents(){//the relation between the Document model and the Offer model is many to 1. So, many Images are included by a one offer.

        return $this->hasMany('App\Document');
        }
   
}
