<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends BaseController
{
    //
    public function index()
    {
        $categories = Categorie::paginate(6);

        return $this->sendResponse([$categories], 'Categories retrieved successfully.');
    }

    public function store(Request $request)
    {
        $categories = $request->validate([
            'name' => 'required',
        ]);
        
        Categorie::create($categories);

        return $this->sendResponse([$categories], 'Categories created successfully.');
    }

    public function update(Request $request, $id)
    {
        //
        $categories = Categorie::findOrFail($id);

        $categories->update([
            'name' => $request->name,
        ]);

        $categories->save();

        return $this->sendResponse([$categories], 'Categories updated successfully');
    }

    public function destroy($id)
    {
        $categories = Categorie::findOrFail($id);
        $categories->delete($id);

        return $this->sendResponse([$categories], 'Categories deleted successfully');
    }
}
