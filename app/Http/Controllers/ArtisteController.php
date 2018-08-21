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
        $artist= Artiste::orderBy('created_at', 'desc')->get();
        $arr=new Artiste();
        $apiNdb=$arr->api_artist();
        return [$artist,$apiNdb];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

        request()->validate([
            'nom' => ['required'],
            'prenom' => ['required'],
            'slug' => ['required'],
        ]);

        return Artiste::create([

            'nom' => request('nom'),
            'prenom' => request('prenom'),
            'slug' => request('slug'),
        ]);


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
