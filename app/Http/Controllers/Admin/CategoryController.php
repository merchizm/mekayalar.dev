<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Admin/Category/Index', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);
        $data['image'] = 'https://via.placeholder.com/150';
        $category = Category::create($data);

        return redirect()->back()->with('success', 'Category created successfully');
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

            return redirect()->back()->with('success', 'Category updated successfully');
        }catch (ModelNotFoundException $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try{
            $category->delete();

            return redirect()->back()->with('success', 'Category deleted successfully');

        }catch (ModelNotFoundException $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
