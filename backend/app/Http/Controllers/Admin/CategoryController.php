<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\ApiResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('perPage')) {
            return ApiResource::collection(Category::filter($request->all())->paginate($request->perPage));
        }
        return ApiResource::collection(Category::filter($request->all())->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {


        $category = DB::transaction(function () use ($request) {
            $category = Category::create($request->validated());
            if ($request->image) {
                $category->addMedia($request->image)->toMediaCollection('primary');
            }
            return $category;
        });


        return Response::success("Created successfully", $category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return new ApiResource($category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        DB::transaction(function () use ($request, $category) {
            $category->update($request->validated());
            if ($request->image) {
                $category->addMedia($request->image)->toMediaCollection('primary');
            }
        });
        return Response::success("Updated successfully", $category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
