<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomLoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.custom-login'); // Ganti path view jika berbeda
    }
}
