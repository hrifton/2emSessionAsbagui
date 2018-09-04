<?php

namespace App\Http\Controllers\Admin;

use App\Model\user\artiste_type;
use App\Model\user\artiste_type_show;
use App\Model\user\artists;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Artiste_typeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {/*
        request()->validate([
            'lastname' => ['required'],
            'firstname' => ['required'],
            'job' => ['required'],

        ]);

        return artiste_type_show::create([

            'artiste_id'=>Artists::where( 'lastname','=',request('lastname'))->where('firstname','=', request('firstname'))->select('id')->get(),
            'type_id'=>type::where( 'type','=',request('job'))->select('id')->get(),

        ]);*/
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
