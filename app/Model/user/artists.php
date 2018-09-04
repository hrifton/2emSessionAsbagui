<?php

namespace App\Model\user;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class artists extends Model
{
    use SoftDeletes;
    protected $fillable = ['lastname','firstname'];
    protected $dates = ['deleted_at'];




    public function types(){
        return $this->belongsToMany(Type::class,'artiste_types','artist_id','type_id');
    }

    public function connectApi(){

        $ListUrl = 'https://api.theatredelaville-paris.com/people';
        $maps_json = file_get_contents($ListUrl);
        $arr = json_decode($maps_json, true);
        $arr = collect($arr["hydra:member"]);
        //insertion de nouveau artiste via api
        $tabArt=array();
        foreach ($arr as $key) {
            $ArtisteUrl = 'https://api.theatredelaville-paris.com' . $key['@id'];
            $fJson = file_get_contents($ArtisteUrl);
            $art = json_decode($fJson, true);

           if (Artists::where( 'firstname','=',$art["name"])->where('lastname','=', $art["familyName"])->first()==null) {
               $tabArt[] = [$art["name"], $art["familyName"], $art["jobTitle"]];

            }
        }

       return $tabArt;

    }

    public function getTypes($job){
        return type::where('type','=',$job)->select('id')->get();
    }
}
