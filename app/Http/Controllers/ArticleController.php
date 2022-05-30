<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    //
    public function index()
    {
        //
        /* Getting all the articles that belong to the current user. */
        $articles = Article::with('categories')->where('users_id', Auth::user()->id)->paginate(3);

        // dd($articles);
        
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        //
        $categories = Categorie::all();
        return view('articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png'
        ]);

        $data = $request->file('image')->store('images', 'public');

        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $data,
            'users_id' => Auth::user()->id,
            'categories_id' => $request->categories_id,
        ]);

        return redirect()->route('article.index')->with('success', 'Sukses menambahkan artikel');
    }

    public function edit($id)
    {
        //
        $article = Article::findOrFail($id);

        $categories = Categorie::all();

        return view('articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, $id)
    {
        //
        $article = Article::findOrFail($id);

        if($request->file('image'))
        {
            //menghapus data file gambar sebelumnya
            Storage::delete('public/'.$article->image);
            
            $image = $request->file('image')->store('images', 'public');
            $article->image = $image;
        }
        

        $article->update([
            'title' => $request->title,
            'content' => $request->content,
            'categories_id' => $request->categories_id,
        ]);

        $article->save();

        return redirect()->route('article.index')->with('success', 'Berhasil mengedit artikel');
    }
}
