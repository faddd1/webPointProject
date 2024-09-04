<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;
            return view('page.hompage', compact('role'));
        } else {
            // Redirect atau tangani jika pengguna tidak terautentikasi
            return redirect()->route('login')->with('error', 'You need to login first.');
        }
    }
}
