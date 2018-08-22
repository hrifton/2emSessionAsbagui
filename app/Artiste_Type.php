<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artiste_Type extends Model
{
   
    protected $table = 'artistes_types';
    protected $fillable = ['artiste_id','type_id'];
}
