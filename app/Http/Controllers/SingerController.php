<?php

namespace App\Http\Controllers;

use App\Models\song;
use App\Models\Singer;
use Illuminate\Http\Request;

class SingerController extends Controller
{
    public function add_singer(){
        $singer = new Singer();
        $singer->name="Tony kakkar";
        $singer->save();

        $songsids=[1,2];
        $singer->songs()->attach($songsids);
    }

    //get singer based on song id

    
        public function show_singer($id){
            $singer= song::find($id)->singers;
           return $singer;   
        }
  
}
