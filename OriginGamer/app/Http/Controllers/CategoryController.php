<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        if(auth()->user()->hasPermissionTo('view category') == false){
            return response()->json(['message' => 'You are not authorized to view categories'], 403);
        }
        else 
        {
        $categories = Category::orderBy('id')->get();
        return response()->json([
            'status' => 'success',
            'categories' => $categories,
        ]);
    }
    }
    public function store(StorecategoryRequest $request)
    {
        if(auth()->user()->hasPermissionTo('create category') == false){
            return response()->json(['message' => 'You are not authorized to create categories'], 403);
        }
        else 
        {
        $category = Category::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "category Created successfully!",
            'category' => $category
        ], 201);
    }
    }

    public function show(Category $category)
    {
        if(auth()->user()->hasPermissionTo('view category') == false){
            return response()->json(['message' => 'You are not authorized to view categories'], 403);
        }
        else 
        {
        $category->find($category->id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        return response()->json($category, 200);
    }
    }

    public function update(StorecategoryRequest $request, Category $category)
    {
        if(auth()->user()->hasPermissionTo('update category') == false){
            return response()->json(['message' => 'You are not authorized to edit categories'], 403);
        }
        else 
        {
        $category->update($request->all());

        if (!$category) {
            return response()->json(['message' => 'category not found'], 404);
        }

        return response()->json([
            'status' => true,
            'message' => "category Updated successfully!",
            'category' => $category
        ], 200);
    }
    }

    public function destroy(Category $category)
    {
        if(auth()->user()->hasPermissionTo('delete category') == false){
            return response()->json(['message' => 'You are not authorized to delete categories'], 403);
        }
        else 
        {
        $category->delete();

        if (!$category) {
            return response()->json([
                'message' => 'Category not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Category deleted successfully'
        ], 200);
    }
}
}