<?php

namespace App\Http\Controllers;

use App\Artiste;
use App\Artiste_Type;
use App\Type;
use Illuminate\Http\Request;

class Artiste_TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artist_id=Artiste::where('slug','Estelle Clément-Bealem')->pluck('id');
        $type_id=Type::where('type','Auteur')->pluck('id');
        $type_id=reset($type_id);
        $type_id=reset($type_id);
        echo $type_id;


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {   $artist_id=Artiste::where('slug',request('slug'))->pluck('id');
        $type_id=Type::where('type',request('type'))->pluck('id');
        $artist_id=reset($artist_id);
        $artist_id=reset($artist_id);
        $type_id=reset($type_id);
        $type_id=reset($type_id);

        return Artiste_Type::create([
            'artiste_id' => $artist_id,
            'type_id'=>$type_id]);
return "artisteTYpe pppppppp";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
