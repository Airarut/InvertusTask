<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('states')->get();//pluck('name');
        $items = DB::table('items')->get();
        return view('home', ['data' => $data], ['items' => $items]);
    }

    function insert(Request $req) {
        $userId = Auth::user()->id;
        $name = $req->input('task_name');
        $description = $req->input('task_description');
        $state = 1;
        $created_at = Carbon\Carbon::now();
        $updated_at = Carbon\Carbon::now();

        $data = array("userId"=>$userId,"name"=>$name,"description"=>$description,"state"=>$state,"created_at"=>$created_at,"updated_at"=>$updated_at);
        DB::table('items')->insert($data);

        return back();

    }

    function delete($id){
        $res=DB::table('items')->where('id',$id)->delete();

        return back();
    }

    function update(Request $req, $id) {
        DB::table('items')->where('id', $id)->update(['state' => $req->state]);
    }
    
}
