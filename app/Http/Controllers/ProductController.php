<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addproduct(Request $request)
    {
        $user = auth()->user();

        if(!$user->is_admin)
        {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $request->only([
            'name','quantity','description','image',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // Generating a unique name
            $image->move(public_path('images'), $imageName);
            $imagepath = 'images/' . $imageName;
        } else {
            $imagepath = null;
        }



        $product = Product::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'image' =>$imagepath,
        ]);

        return response()->json($product, 201);
    }

    public function getproducts(Request $request)
    {
        $products = Product::get();

        return response()->json($products,200);
    }

}
