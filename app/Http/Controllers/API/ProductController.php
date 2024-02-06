<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class ProductController extends Controller
//* INFO  remember to name funtctions has they are named in routes, id becomes the object
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create( $request->validated());
        return $product;
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        if($product){
            $product->update($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if($product){
            $product->delete($product);
        }
    }

    public function searchByCatergories($categoryId){

        $products = Product::whereHas('categories', function (Builder $query) use ($categoryId) {
            $query->where('category_id', $categoryId);
        })->get();

        return $products;
    }
}