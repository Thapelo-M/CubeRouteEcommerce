<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    //Add a category
    public function addCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
        ]);

        $category = Category::create(['name' => $validated['name']]);
        $categories = Category::all();

        return view('categories', compact('categories'));

    }
    //Delete a category
    public function destroyCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $category->delete();

        //Return to categories
        $categories = Category::all();
        return view('categories', compact('categories'));

    }

    //Edit category
    public function showCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        return view('editCategory', compact('category'));
    }

    //Update Category
    public function updateCategory(Request $request, $categoryId)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
        ]);

        $category = Category::findOrFail($categoryId);
        $category->update(['name' => $validated['name']]);

        $categories = Category::all();
        return view('categories', compact('categories'));
    }
}
