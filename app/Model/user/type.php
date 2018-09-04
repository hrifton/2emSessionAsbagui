<?php

namespace App\Model\user;
use App\Model\user\artists;

use Illuminate\Database\Eloquent\Model;

class type extends Model
{
    protected $fillable = ['type'];

    public function artists(){
        return $this->belongsToMany(Artists::class);
    }
}
