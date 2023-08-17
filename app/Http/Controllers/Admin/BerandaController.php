<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        echo QrCode::size(100)->generate('https://techvblogs.com/blog/generate-qr-code-laravel-8');
    }
}
