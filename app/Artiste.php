<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artiste extends Model
{

    public function types(){
        return $this->belongsToMany('App\\Models\Type','artistes_types','id','type_id');
    }

    protected $fillable = ['nom', 'prenom', 'slug'];

    public function getall(){
        $artist= Artiste::orderBy('created_at', 'desc')->get();
        $arr=new Artiste();
        $apiNdb=$arr->api_artist();
        return [$artist,$apiNdb];
    }

    public function saveArtiste(){

        if(Artiste::where('slug',request('slug'))->count()==0){
            request()->validate([
                'nom' => ['required'],
                'prenom' => ['required'],
                'slug' => ['required'],
            ]);

            return Artiste::create([

                'nom' => request('nom'),
                'prenom' => request('prenom'),
                'slug' => request('slug'),
            ]);}
        else{ echo"existe deja";}
    }

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
