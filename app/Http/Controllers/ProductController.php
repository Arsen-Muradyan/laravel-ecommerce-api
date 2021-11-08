<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;


class ProductController extends Controller
{
    /**
    * @route /api/products/
    * @method GET
    */
   public function index() 
   {
        return Product::all();
   }

    /**
    * @route /api/products/
    * @method POST
    */   
   public function store(Request $request) 
   {
        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required',
            'image' => 'required',
        ]);

        return Product::create($request->all());
   }

    /**
    * @route /api/products/{id}
    * @method GET
    */
    public function show($id)
    {
        return Product::findOrFail($id);  
    }

    /**
    * @route /api/products/{id}
    * @method PUT
    * @desc Update product
    */
   public function update(Request $request, $id)
   {
       $product = Product::findOrFail($id);
       $product->update($request->all());
       return $product;
   }

   /**
    * @route /api/products/{id}
    * @method DELETE
    * @desc Delete Product    
    */
   public function destroy($id)
   {
       return Product::destroy($id);
   }

   /**
    * @route /api/products/search/{name}
    * @method GET
    * @desc Search Product    
    */
   public function search($name)
   {
       return Product::where('name', 'like', '%'.$name.'%')->get();
   }
}
