<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'name','img_dir'
    ];
    public function user(){

        return $this->belongsTo('App\User');
    }

    public function offer(){

        return $this->belongsTo('App\Offer');
}
}
