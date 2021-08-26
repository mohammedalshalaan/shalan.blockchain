<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'name','description','total_offer_for_sell'
    ];
    public function user(){

        return $this->belongsTo('App\User');
    }
    
    public function offers(){

    return $this->hasMany('App\Offer');

}
}
