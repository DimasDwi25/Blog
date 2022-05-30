<?php

namespace App\Http\Controllers\API\V1;

use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ArticleResource;
use Illuminate\Support\Facades\Storage;

class ArticleController extends BaseController
{
    //
    public function index()
    {
        $articles = Article::with('categories')->paginate(3);

        return $this->sendResponse([$articles], 'Articles retrieved successfully.');
        
    }

    public function show($id)
    {
        $article = Article::with('categories')->findOrFail($id);

        return $this->sendResponse([$article], 'Article retrieved successfully.');
    }

    public function store(Request $request)
    {

        $data = $request->file('image')->store('images', 'public');

        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png'
        ]);

        $articles = new Article([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $data,
            'users_id' => Auth::user()->id,
            'categories_id' => $request->categories_id,
        ]);

        $articles->save();

        return $this->sendResponse([$articles], 'Article created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|mimes:jpg,jpeg,png'
        ]);
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

        return $this->sendResponse([$article], 'Article updated successfully.');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        $article->delete();

        return $this->sendResponse([$article], 'Article deleted successfully.');
    }
}

