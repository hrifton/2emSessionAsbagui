<?php

namespace App\Http\Controllers\Admin;

use App\Model\user\artists;
use App\Model\user\type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtisteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Artists::orderBy('created_at', 'desc')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ApiArtiste()
    {
        $artist= new artists();
        return $artist->connectApi();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        request()->validate([
            'lastname' => ['required'],
            'firstname' => ['required'],
            'job' => ['required'],

        ]);
        $artiste=Artists::create([

            'lastname' => request('lastname'),
            'firstname' => request('firstname'),


        ]);

        //recuperation de l'id du job
        $job=request('job');

        $type_id=type::where('type','=', $job)->pluck('id')->first();
        if(!$type_id){
            type::create([
                'type'=>$job
            ]);
            $type_id=type::where('type','=', $job)->pluck('id')->first();
        }

        //insertion dans la table relationnel
        $artiste->types()->attach($type_id);

        return $artiste;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'lastname' => ['required'],
            'firstname' => ['required'],

        ]);
        $nerd = Artists::find($id);
        $nerd->lastname = request('lastname');
        $nerd->firstname = request('firstname');
        $nerd->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {dump($id);
        $array=explode(',', $id);
        dump($array);
        if(count($array)>0){
            for($i=0;$i<count($array);$i++){

                $art=Artists::find($array[$i]);
                $art->delete();

            }
        }else{ $art=Artists::find($id);
            $art->delete();}

            unset($array);







    }
}
