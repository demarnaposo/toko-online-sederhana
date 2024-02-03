<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index() {

        return view('login');
    }

    public function register(Request $request) {

        // insert data ke db "tbl_user"

        DB::table('tbl_user')->insert([
            'nama_user' => $request->nama,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return redirect('/login');

    }

    public function masuk(Request $request) {

        $user = DB::table('tbl_user')->where('email', $request->email)->first();
        if($user->password == $request->password){
            Session::put('id_user', $user->id);
            echo 'Data disimpan dengan session id = '.$request->session()->get('id');
            return redirect('/');
        }else{

            echo 'Gagal Login!';
        }

    }


    public function logout(){
        Session::forget('id_user');
        return redirect('/');
    }
}
