<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blockchain extends Model
{
    protected $fillable = [
        'owner'
    ];
    public function user(){

        return $this->belongsTo('App\User');
    }

    public function offer(){

        return $this->belongsTo('App\Offer');
}
}
