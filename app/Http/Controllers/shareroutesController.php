<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\shareroute;
use DB;



class shareroutesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allRoutes = shareroute::all();//Returnerar allt från tabellen i jsonformat
        return view('home')->with('shareposts',$allRoutes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        //Lägger in värderna från formulär 
        $name = $request->input('textin');
       DB::insert('insert into shareroutes (saveroutes_travelInfo) values (?)', [$name]);
        
       //Hämtar den senaste posten
       $last_post = shareroute::orderBy('id', 'desc')->first();
       
       //Hämtar informationen från databasen
        $routeOut = shareroute::find($last_post->id);

        //Går vidare till View Socialmedia med info från senast sparade post i databas
        return view('socialmedia')->with('sharepost',$routeOut);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $routeOut = shareroute::find($id);
        return view('socialmedia')->with('sharepost',$routeOut);
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
