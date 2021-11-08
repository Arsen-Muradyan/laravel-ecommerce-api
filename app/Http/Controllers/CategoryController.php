<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /** 
    * @route /api/categories
    * @method POST
    */
    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required|string'
        ]);
        $category = Category::create([
            'name' => $request->name
        ]);
        return response($category, 201);
    }
    /**
    * @route /api/categories
    * @method GET
    */
    public function index()  
    {
        return Category::all();
    }
    /**
    * @route /api/categories/{id}/products
    * @method GET
    * @desc Return all products at specified category
    */
    public function products($id) 
    {
        $category = Category::find($id);
        return ($category->products);
    }
    /**
    * @route /api/categories/{id}
    * @method DELETE
    * @desc Delete category
    */
    public function destroy($id) 
    {
        return Category::destroy($id);
    }
}
