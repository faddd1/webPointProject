<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){

        $data = User::get();
        return view ('tambahUser.tambahakun', [
            'data' => $data,
            'title' => 'Tambah Akun'
        ]);
    }

    public function create(){
        return view ('tambahUser.buatakun', [
            'title' => 'Tambah Akun'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required',
            'plain_password'
        ], [

            'username.unique' => 'Username sudah digunakan, silakan pilih yang lain.',
        ]);
    
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'role' => $request->role,
            'password' => $request->password,
            'password' => Hash::make($request['password']),
            'plain_password' => $request['password'],
        ]);

        return redirect('/tambah');
    }

    public function edit(User $data, $id){

        $data = User::findOrFail($id);
        return view('tambahUser.editakun', compact('data'), [
            
            'title' => 'title'
        ]);
    }

    public function update(Request $request, User $data, $id){

        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required',
            'plain_password'
        ], [
            'username.unique' => 'Username sudah digunakan, silakan pilih yang lain.',
        ]);
        $data = User::find($id);
        $data->update([
            'name' => $request->name,
            'username' => $request->username,
            'role' => $request->role,
            'password' => $request->password,
            'password' => Hash::make($request['password']),
            'plain_password' => $request['password'],
        ]);

        

        return redirect('/tambah');

    }
    
    public function profil(){
        $datas = User::get();
       return view('profile.profile', [
        'datas' => $datas,
        'title' => 'Profile'
       ]);
    }

    public function storee(Request $request){

        $request->validate([
            'name'=>'required',
            'role'=>'required'
        ]);
    }

    public function destroy(Request $request, User $data, $id){

        $data = User::findOrFail($id);
        $data->delete();
        return redirect('/tambah');
    }
}
