<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(){
        return view('page.home.home');
    }

    public function homepage(){
        return view('page.home.hompage');
    }
}
           
        
