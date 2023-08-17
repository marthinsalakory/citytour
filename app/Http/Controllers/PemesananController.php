<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PemesananController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'auth',
        ]);
    }

    public function index()
    {
        if (Auth::user()) if (Auth::user()->role == 'admin') return redirect(url('/admin'));
        return view('pemesanan', [
            'jml_pesanan' => Pesanan::where('user_id', '=', Auth::user()->id)->count(),
            'pesanan' => DB::table('pesanan')->where('user_id', '=', Auth::user()->id)->first(),
        ]);
    }

    public function post(Request $request)
    {
        $request->validate([
            'quota' => 'required'
        ]);

        if (Pesanan::create([
            'id' => uniqid(),
            'user_id' => Auth::user()->id,
            'quota' => $request->quota,
        ])) {
            return Redirect()->back()->with('berhasil', 'Berhasil Melakukan Pemesanan<br><strong>Klik Detail untuk melihat pesanan</strong>');
        }
        return  Redirect()->back()->with('gagal', 'Gagal memproses pesanan, silahkan coba lagi!');
    }
}
