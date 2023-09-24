<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::paginate(6);
        return view('frontend.products.index' , compact('products', 'categories'));
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('frontend.products.show' , compact('product'));
    }

    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');

        // Search in the title and body columns from the posts table
        $searchProducts = Product::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('slug', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->paginate(6);

        // Return the search view with the resluts compacted
        $bestSelling = Product::with('category')->inRandomOrder()->take(8)->get();
        return view('frontend.search', compact('searchProducts','bestSelling'));
    }


}
