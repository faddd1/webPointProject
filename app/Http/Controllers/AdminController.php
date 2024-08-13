<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

        function index(){

         return view('page.dashboard', [

        'title' => 'Dashboard'
     ]);
    
        }

        function admin(){

            return view('page.dashboard', [
    
            'title' => 'Dashboard'
        ]);
        
            }
        
            function guru(){

                return view('page.dashboard', [
        
                'title' => 'Dashboard'
            ]);
            
                }

                function petugas(){

                    return view('page.dashboard', [
            
                    'title' => 'Dashboard'
                ]);
                
                    }

                    function siswa(){

                        return view('page.dashboard', [
                
                        'title' => 'Dashboard'
                    ]);
                    
                        }

        
        
}