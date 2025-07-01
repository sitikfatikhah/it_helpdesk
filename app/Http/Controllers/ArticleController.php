<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function showArticle()
    {
        return view('auth.article'); // Ganti path view jika berbeda
    }
}
