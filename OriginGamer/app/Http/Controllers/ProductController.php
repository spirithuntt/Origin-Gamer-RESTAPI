<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->hasPermissionTo('view product') == false){
            return response()->json(['message' => 'You are not authorized to view products'], 403);
        }
        else 
        {
        return response()->json([
            'status' => 'success',
            'products' => Product::all()
        ], 200);
    }
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
    public function store(Request $request)
    {
        if(auth()->user()->hasPermissionTo('create product') == false){
            return response()->json(['message' => 'You are not authorized to create products'], 403);
        }
        else 
        {
        $product = Product::create($request->all());
        return response()->json([
            'status' => 'success',
            'product' => $product
        ], 200);
    }
    }

    /**
     * Display the specified resource.
     */
    public function show($product)
    {
        if(auth()->user()->hasPermissionTo('view product') == false){
            return response()->json(['message' => 'You are not authorized to view products'], 403);
        }
        else 
        {
        return response()->json([
            'status' => 'success',
            'product' => Product::find($product)
        ], 200);
    }
    }
    public function filterByCategory($category_id)
    {
        $products = Product::where('category_id', $category_id)->get();
        return response()->json([
            'status' => 'success',
            'products' => $products
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if(auth()->user()->hasPermissionTo('update product') == false){
            return response()->json(['message' => 'You are not authorized to edit products'], 403);
        }
        else 
        {
        $product->update($request->all());
        return response()->json([
            'status' => 'success',
            'product' => $product
        ], 200);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
{
    if(auth()->user()->hasPermissionTo('delete product') == false){
        return response()->json(['message' => 'You are not authorized to delete products'], 403);
    }
    else 
    {
    if(!$product->delete()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Product could not be deleted'
        ], 500);
    }
    return response()->json([
        'status' => 'success',
        'message' => 'Product deleted successfully'
    ], 200);
}
}
}
