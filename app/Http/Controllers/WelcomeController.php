<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //
    public function index()
    {
        $article = Article::with('categories', 'user')->paginate(3);

        // dd($article);
        return view('welcome', compact('article'));
    }

    public function show($id)
    {
        $article = Article::with('categories', 'user')->findOrFail($id);

        // dd($article);

        return view('articleDetail', compact('article'));
    }
}
