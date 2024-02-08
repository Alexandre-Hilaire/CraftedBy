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

        $this->authorize('store', Product::class);

        $product = Product::create([
            'user_id'=>$request->validated()['user_id'],
            'name'=>$request->validated()['name'],
            'pModel_id'=>$request->validated()['pModel_id'],
            'unit_price'=>$request->validated()['unit_price'],
            'description'=>$request->validated()['description'],
            'status'=>$request->validated()['status'],
            'color'=>$request->validated()['color'],
            'customizable'=>$request->validated()['customizable'],
            'is_active'=>$request->validated()['is_active'],
        ]);

        $product->categories()->attach($request->validated()['categories_ids']);

        $product->materials()->attach($request->validated()['materials_ids']);

        return $product->load(['categories', 'materials']);
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
        $this->authorize('update', $product);
        $product->update(['user_id'=>$request->validated()['user_id'],
        'name'=>$request->validated()['name'],
        'pModel_id'=>$request->validated()['pModel_id'],
        'unit_price'=>$request->validated()['unit_price'],
        'description'=>$request->validated()['description'],
        'status'=>$request->validated()['status'],
        'color'=>$request->validated()['color'],
        'customizable'=>$request->validated()['customizable'],
        'is_active'=>$request->validated()['is_active'],
        ]);
        

        $product->categories()->attach($request->validated()['categories_ids']);

        $product->materials()->attach($request->validated()['materials_ids']);

        return $product->load(['categories', 'materials']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

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