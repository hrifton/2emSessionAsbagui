<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artiste extends Model
{
    protected $fillable = ['nom', 'prenom', 'slug'];






    public function api_artist()
    {$artist=Artiste::all();
        $bool=false;
        $ListUrl = 'https://api.theatredelaville-paris.com/people';
        $maps_json = file_get_contents($ListUrl);
        $arr = json_decode($maps_json, true);
        $arr = collect($arr["hydra:member"]);
        $array=array();
        foreach ($arr as $key=>$value){
            foreach ($artist as $key=>$val){
                if($value['fullName']==$val['slug']){
                    $bool=true;
                    break;
                }else{
                    $bool=false;
                }
            }
            if($bool==false){
                $array[]=$value;
            }
        }
        return $array;
    }






}
