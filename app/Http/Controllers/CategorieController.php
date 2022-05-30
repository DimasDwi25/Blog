<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategorieController extends Controller
{
    //
    public function index()
    {
        //
        $categorie = DB::table('categories')->paginate(6);

        return view('categories.index', compact('categorie'));
    }

    public function create()
    {
        //

        return view('categories.create');
    }

    public function store()
    {
        //
        $data = request()->validate([
            'name' => 'required',
        ]);

        Categorie::create($data);

        return redirect()->route('categorie.index')->with('success', 'Sukses menambahkan kategori');
    }

    public function update(Request $request, $id)
    {
        $categorie = Categorie::findOrFail($id);

        $categorie->update([
            'name' => $request->name,
        ]);

        $categorie->save();

        return redirect()->route('categorie.index')->with('success', 'Sukses mengubah kategori');
    }

    public function destroy($id)
    {
        $categorie = Categorie::findOrFail($id);

        $categorie->delete();

        return redirect()->route('categorie.index')->with('success', 'Sukses menghapus kategori');
    }
    
}
