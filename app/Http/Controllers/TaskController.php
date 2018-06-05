<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Task;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::all();
        // $tasks = DB::table('tasks')->get();
        // return $tasks;
         return view('create',compact('tasks'));
     }
     public function create(){
        echo 'create';
     }
     public function store(Request $request){
       // dd(request()->all());

         //Lägger in värderna från formulär 
        $name = $request->input('body');
        DB::insert('insert into tasks (body) values (?)', [$name]);
          //Hämtar den senaste posten
       $last_post = Task::orderBy('id', 'desc')->first();
       //Hämtar informationen från databasen
        $routeOut = Task::find($last_post->id);
        //Går vidare till View Socialmedia med info från senast sparade post i databas
        return view('/share')->with('sharepost',$routeOut);

     /*   $post = new Task;
        $post->body = request('body');
        $post->save();*/
     }
     public function show($id){
         //return view('share',compact('task'));
         $routeOut = Task::find($id);
         return view('/share')->with('sharepost',$routeOut);
     }
}
