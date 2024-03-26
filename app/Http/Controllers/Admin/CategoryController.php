<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();

        $category = Category::create($data);

        return response()->json([
            'category' =>   $category,
            'message' => 'Category created successfully',
            'type' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        try{
            return response()->json([
                'category' =>   $category,
                'message' => 'Category retrieved successfully',
                'type' => 'success',
            ]);
        }catch (ModelNotFoundException $exception){
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try{
            $data = $request->validated();

            $category->update($data);

            return response()->json([
                'category' =>   $category,
                'message' => 'Category updated successfully',
                'type' => 'success',
            ]);
        }catch (ModelNotFoundException $exception){
            return response()->json([
                'message' => $exception->getMessage(),
                'type' => 'error'
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try{
            $category->delete();

            return response()->json([
                'message' => 'Category deleted successfully',
                'type' => 'success',
            ]);

        }catch (ModelNotFoundException $exception){
            return response()->json([
                'message' => $exception->getMessage(),
                'type' => 'error'
            ], 400);
        }
    }
}
