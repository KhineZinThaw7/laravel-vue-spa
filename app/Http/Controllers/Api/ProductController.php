<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return $products;
    }

    public function store(Request $request)
    {
        $product = new Product;
        $product->title = $request->title;
        $product->price = $request->price;
        $product->description = $request->description;
    
        if($request->hasFile('image')){
            $image = $request->file('image'); 
            $imageName = time().$image->getClientOriginalName();
            $request->file('image')->storeAs('public/product-images',$imageName);
            $product->image = '/storage/product-images/'.$imageName;
        }

        $product->save();
        return $product;
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return $product;
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->title = $request->title;
        $product->price = $request->price;
        $product->description = $request->description;
    
        if($request->hasFile('image')){
            Storage::delete('/public/product-images/'.$product->image);
            $image = $request->file('image'); 
            $imageName = time().$image->getClientOriginalName();
            $request->file('image')->storeAs('public/product-images',$imageName);
            $product->image = '/storage/product-images/'.$imageName;
        }

        $product->update();
        return $product;
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return $product;
    }
}
