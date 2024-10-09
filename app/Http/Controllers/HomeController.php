<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function home(){
        return view('page.home.home');
    }
    public function send(Request $request)
    {
        // Validasi form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);
        
        // Kirim email
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'user_message' => $request->input('message'), // Ganti nama variabel message
        ];
        
        Mail::send('send.ctc', $data, function($mail) use ($data) {
            $mail->to("adefarhan425@gmail.com")
                 ->subject('Pesan Baru dari Form Kontak');
            $mail->from($data['email'], $data['name'], $data['subject']);
        });
        
        return back()->with('success', 'Pesan berhasil dikirim!');
    }
}
           
        
