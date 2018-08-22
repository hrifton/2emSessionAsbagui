<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function artistes(){
    return $this->belongsToMany('App\\Models\Artiste','artistes_types','id','artiste_id');
}

    protected $fillable = ['type'];
}
