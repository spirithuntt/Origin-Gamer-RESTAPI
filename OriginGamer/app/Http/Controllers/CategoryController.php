<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

// api crud
class CategoryController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }
    /**
     * Display a listing of the resource.
     */

    //  api crud laravel
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'categories' => Category::all()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json([
            'status' => true,
            'message' => 'Category created successfully'
        ], 201);

    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = Category::create($request->all());
    
        return response()->json([
            'status' => 'success',
            'category' => $category
        ], 200);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json([
            'status' => 'success',
            'category' => $category
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return response()->json([
            'status' => 'success',
            'category' => $category
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->name = $request->input('name');
        $category->save();
    
        return response()->json([
            'status' => 'success',
            'category' => $category
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
    
        return response()->json([
            'status' => 'success',
            'category' => $category
        ], 200);
        if(!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found'
            ], 404);
        }
    }
}
