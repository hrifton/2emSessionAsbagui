<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artiste;



class ArtisteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artist=new Artiste();
        return $artist->getall();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $a=new Artiste;
        return $a->saveArtiste();
    }


    public function update(Request $request, $id)
    {
        $nerd = Artiste::find($id);
        $nerd->nom       = request('nom');
        $nerd->prenom      = request('prenom');
        $nerd->slug = request('slug');
        $nerd->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $artist=Artiste::find($id);
        $artist->delete();

    }
}
