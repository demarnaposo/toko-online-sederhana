<?php

namespace App\Http\Controllers;

use App\M_Barang;
use Illuminate\Http\Request;

class UtamaController extends Controller
{
    public function index () {

        return view('utama');

    }

    public function store(Request $request) {

        $this->validate($request, [
            'file' => 'required|max:2048'
        ]);

        $file = $request->file('file');
        $nama_file = time()."_".$file->getClientOriginalName();
        $upload = 'data_file';
        if($file->move($upload, $nama_file)) {
            $data = M_Barang::create([
                'nama_produk' => $request->nama_produk,
                'harga' => $request->harga,
                'gambar' => $nama_file
            ]);
            $res['message'] = "Success!";
            $res['values'] = $data;
            return response($res);
        }

    }
}
