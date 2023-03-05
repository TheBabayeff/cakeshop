<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ApiResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        if ($request->has('perPage')) {
            return ApiResource::collection(Product::with('category')->filter($request->all())->paginate($request->perPage));
        }
        return ApiResource::collection(Product::filter($request->all())->get());
    }


    public function create()
    {
        //
    }


    public function store(ProductRequest $request)
    {
        $product = DB::transaction(function () use ($request) {
            $product = Product::create($request->validated());


            if ($request->image) {
                $product->addMedia($request->image)->toMediaCollection('product-photo');
            }

            return $product;
        });
        return Response::success("Created successfully", $product);
    }

    public function show(Product $product)
    {
        return new ApiResource($product->load('category'));
    }


    public function edit(string $id)
    {
        //
    }


    public function update(ProductRequest $request, Product $product)
    {
        DB::transaction(function () use ($request, $product) {
            $product->update($request->validated());
            if ($request->image) {
                $product->addMedia($request->image)->toMediaCollection('product-photo');
            }
        });
        return Response::success("Updated successfully", $product);
    }


    public function destroy(Product $product)
    {
        if ($product->delete()) {
            return Response::success("Deleted successfully");
        }
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();
        return new ApiResource($product);
    }

    public function forceDelete($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        if ($product->forceDelete()) {
            return Response::success("Force deleted successfully");
        };
    }

}
