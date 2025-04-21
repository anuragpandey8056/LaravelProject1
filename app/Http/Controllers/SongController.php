<?php

namespace App\Http\Controllers;

use App\Models\song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    public function add_song(){
        $song= new song();
        $song->title='baby chocolate hai';
        $song->save();
        
    }

    //get song based on singer id
    public function show_song($id){
        $song= Singer::find($id)->songs;
       return $song;   
    }

}
