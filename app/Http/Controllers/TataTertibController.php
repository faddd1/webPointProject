<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TataTertibController extends Controller
{
    public function tampilanTata()
    {
        return view('tataTertib.tatapoin',[
            'title' => 'Tata Tertib'
        ]);
    }
}
