<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'title','content','image','hash','value','owner','hex_data','hex_id','hash_picture','certificate_id','state','valid'
    ];
    public function user(){

        return $this->belongsTo('App\User');
    }

    public function area(){

        return $this->belongsTo('App\Area');
    }
    
    public function comments(){

    return $this->hasMany('App\Comment');
    }

    public function documents(){

        return $this->hasMany('App\Document');
        }

        public function blockchain(){

            return $this->hasOne('App\Blockchain');
            }
    
   
}
