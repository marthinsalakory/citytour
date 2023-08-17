<?php

use App\Http\Controllers\PemesananController;
use App\Models\About;
use App\Models\contact;
use App\Models\street_view;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->middleware('role:admin')->group(function () {
    Route::get('/', function () {
        return view('admin/index');
    })->name('admin');

    Route::get('/about', function () {
        return view('admin/about', [
            'isi' => DB::table('about')->where('id', '=', 1)->first()->isi,
        ]);
    })->name('about');

    Route::post('/about', function (Request $request) {
        if (About::where('id', '=', 1)->update(['isi' => $request->isi])) {
            return redirect()->back()->with('berhasil', 'Berhasil mengubah about');
        }
        return redirect()->back()->with('gagal', 'Gagal mengubah about');
    })->name('about');

    Route::get('/contact', function () {
        return view('admin/contact');
    })->name('contact');

    Route::get('/d_contact/{id?}', function ($id = false) {
        if ($id) {
            if (DB::table('contact')->where('id', '=', $id)->delete()) {
                return redirect()->back()->with('berhasil', 'Contact deleted');
            }
        }
        return redirect()->back()->with('berhasil', 'Failed delete to contact');
    })->name('d_contact');

    Route::get('/quota', [App\Http\Controllers\Admin\QuotaController::class, 'index'])->name('quota');

    Route::get('/qrcode/{id?}', function ($id = false) {
        if ($id) {
            if (DB::table('pesanan')->where('id', '=', $id)->count()) {
                $pesanan = DB::table('pesanan')->where('id', '=', $id)->first();
            } else {
                $pesanan = false;
            }
        } else {
            $pesanan = false;
        }
        return view('admin/qrcode', [
            'pesanan' => $pesanan
        ]);
    })->name('qrcode');

    Route::get('/paid/{id?}', function ($id = false) {
        if ($id) {
            if (DB::table('pesanan')->where('id', '=', $id)->update([
                'status' => 'paid'
            ])) {
                $dt = DB::table('pesanan')->where('id', '=', $id)->first();

                DB::table('history')->insert([
                    'id' => $dt->id,
                    'user_id' => $dt->user_id,
                    'quota' => $dt->quota,
                ]);
                return redirect()->back()->with('berhasil', 'Berhasil menambahkan 1 data');
            }
        }
        return redirect()->back()->with('berhasil', 'Gagal menambahkan 1 data');
    })->name('paid');

    Route::get('/history', function () {
        return view('admin.history');
    })->name('history');

    Route::get('/street_view', function () {
        return view('admin.street_view');
    })->name('street_view');
    Route::get('/street_view/{id?}', function ($id = false) {
        if ($id) {
            $images = street_view::where('id', '=', $id)->first()->images;
            if (DB::table('street_view')->where('id', '=', $id)->delete()) {
                unlink('images/' . $images);
                return redirect()->back()->with('berhasil', 'Data deleted');
            }
        }
        return redirect()->back()->with('berhasil', 'Failed delete to data');
    })->name('street_view');

    Route::post('/street_view', function (Request $request) {
        $images = $request->file('images')->hashName();
        $tmp_images = $request->file('images')->getPathname();
        if (street_view::create([
            'images' => $images,
            'name' => $request->name,
            'description' => $request->description,
        ])) {
            move_uploaded_file($tmp_images, 'images/' . $images);
            return redirect()->back()->with('berhasil', 'Berhasil mengubah status pesanan');
        }
        return redirect()->back()->with('gagal', 'Gagal mengubah status pesanan');
    });
});


Route::get('/', function () {
    if (Auth::user()) if (Auth::user()->role == 'admin') return redirect(url('/admin'));
    return view('index');
})->name('beranda');

Route::get('/masuk', function () {
    if (Auth::user()) if (Auth::user()->role == 'admin') return redirect(url('/admin'));
    return view('index', [
        'masuk' => true,
    ]);
})->name('masuk');

Route::get('/daftar', function () {
    if (Auth::user()) if (Auth::user()->role == 'admin') return redirect(url('/admin'));
    return view('index', [
        'daftar' => true,
    ]);
})->name('daftar');

Route::get('/tentang', function () {
    if (Auth::user()) if (Auth::user()->role == 'admin') return redirect(url('/admin'));
    return view('tentang');
})->name('tentang');

Route::get('/pemesanan', [App\Http\Controllers\PemesananController::class, 'index'])->name('pemesanan')->middleware('auth');
Route::post('/pemesanan', [App\Http\Controllers\PemesananController::class, 'post'])->name('pemesanan')->middleware('auth');
Route::get('/hapus_pesanan/{id?}', function ($id = false) {
    if (Auth::user()) if (Auth::user()->role == 'admin') return redirect(url('/admin'));
    if ($id) {
        if (DB::table('pesanan')->where('id', '=', $id)->delete()) {
            return redirect()->back()->with('berhasil', 'Berhasil menghapus pesanan');
        }
    } else if (DB::table('pesanan')->where('user_id', '=', Auth::user()->id)->delete()) {
        return redirect()->back()->with('berhasil', 'Berhasil menghapus pesanan');
    }
    return redirect()->back()->with('berhasil', 'Gagal menghapus pesanan');
})->name('hapus_pesanan');

Route::get('/kontak', function () {
    if (Auth::user()) if (Auth::user()->role == 'admin') return redirect(url('/admin'));
    return view('kontak');
})->name('kontak');

Route::post('/kontak', function (Request $request) {
    if (Auth::user()) if (Auth::user()->role == 'admin') return redirect(url('/admin'));
    if (contact::create([
        'name' => $request->name,
        'email' => $request->email,
        'subject' => $request->subject,
        'message' => $request->message,
    ])) {
        return redirect()->back()->with('message', 'Your message has been sent. Thank you!')->with('color', 'primary');
    } else {
        return redirect()->back()->with('message', 'Sorry, your message failed to send.')->with('color', 'danger')->withInput();
    }
})->name('kontak');

Auth::routes([
    'verify' => true
]);

Route::get('/home/{id?}', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::prefix('admin')->middleware('role:admin')->group(function () {
//     Route::get('/', [App\Http\Controllers\Admin\BerandaController::class, 'index']);
// });
