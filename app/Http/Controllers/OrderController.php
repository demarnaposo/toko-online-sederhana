<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function order (Request $request) {

        DB::table('tbl_keranjang')->insert([
            'id_user' => Session::get('id_user'),
            'id_barang' => $request->id_barang,
            'jumlah' => $request->jumlah,
        ]);
        return redirect('/');
    }

    public function keranjang() {
        $keranjang = DB::table('keranjang')->get();
        return view('keranjangview', ['keranjang' => $keranjang]);
    }

    public function checkout() {
        $id_checkout = rand().rand().rand();
        $total = 0;
        $data = DB::table('tbl_keranjang')->where('id_user', Session::get('id_user'))->get();
        foreach ($data as $krj) {
            $barang = DB::table('tbl_barang')->where('id', $krj->id_barang)->get();
            foreach ($barang as $brg) {
                $total += ($krj->jumlah * $brg->harga);
                DB::table('detail_checkout')->insert([
                    'id_checkout' => $id_checkout,
                    'id_barang' => $krj->id_barang,
                    'jumlah' => $krj->jumlah
                ]);
            }

        }
        DB::table('tbl_checkout')->insert([
            'id_checkout' => $id_checkout,
            'id_user' => Session::get('id_user'),
            'total' => $total
        ]);
        return redirect('/checkoutview');
    }

    public function list_checkout() {
        $checkout = DB::table('checkout')->get();
        return view('checkoutview',['checkout' => $checkout]);
    }

    public function konfirmasi() {
        return view('konfirmasiview');
    }

    public function konfirm_simpan(Request $request) {

        $this->validate($request, [
            'file' => 'required|max:2048'
        ]);

        $file = $request->file('file');
        $nama_file = time()."_".$file->getClientOriginalName();

        $upload = 'data_file';
        if($file->move($upload,$nama_file)) {
            DB::table('tbl_konfirmasi')->insert([
                'id_user' => Session::get('id_user'),
                'id_checkout' => $request->id_token,
                'bukti' => $nama_file
            ]);
            return redirect('/konfirmasiview');
        }

    }
}
