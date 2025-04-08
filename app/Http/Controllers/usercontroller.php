<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class usercontroller extends Controller
{
    public function getuser(){
       return view('home');
    }

    public function getusercontact(){
        return view('contact');
     }

     public function getuserservice(){
        return view('service');
     }
     public function getuserabout(){
        return view('about');
     }
}
