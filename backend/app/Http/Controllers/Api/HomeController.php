<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->get();
        $products = Product::with('category')->inRandomOrder()->take(8)->get();
        $bestSelling = Product::with('category')->inRandomOrder()->take(8)->get();
                $newProducts = Product::orderBy('created_at' , 'desc')->paginate(8);

        return view('welcome', compact('products', 'categories', 'newProducts', 'bestSelling'));
    }
}
