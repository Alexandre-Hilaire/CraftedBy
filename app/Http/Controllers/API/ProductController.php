<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Image;
use App\Models\Pmodel;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
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

        $user = User::findOrFail($request->validated()['user_id']);

        $product = $user->products()->create([
            'name' => $request->validated()['name'],
            'unit_price' => $request->validated()['unit_price'],
            'description' => $request->validated()['description'],
            'status' => $request->validated()['status'],
            'color' => $request->validated()['color'],
            'customizable' => $request->validated()['customizable'],
            'is_active' => $request->validated()['is_active'],
        ]);

        $product->categories()->attach($request->validated()['categories_ids']);

        $product->materials()->attach($request->validated()['materials_ids']);

        $pmodelName = $request->validated()['pmodel_name'];
        if (!empty($pmodelName)) {
            $pModel = Pmodel::where('pmodel_name', $pmodelName)->first();
            if (!$pModel) {
                $pModel = Pmodel::create([
                    'name' => $pmodelName,
                ]);
            }
            $product->pmodel()->associate($pModel->id);
        }
        if ($request->has('image_ids')) {
            $imageIds = $request->validated()['image_ids'];
            foreach ($imageIds as $imageId) {
                $image = Image::find($imageId);
                if ($image) {
                    $product->images()->save($image);
                }
            }
        }

        return $product->load(['categories', 'materials', 'pmodel', 'user','images']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $product->load(['categories', 'materials', 'pmodel', 'user','images']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);

        $product->update([
            'name' => $request->validated()['name'],
            'unit_price' => $request->validated()['unit_price'],
            'description' => $request->validated()['description'],
            'status' => $request->validated()['status'],
            'color' => $request->validated()['color'],
            'customizable' => $request->validated()['customizable'],
            'is_active' => $request->validated()['is_active'],
        ]);

        $user = User::findOrFail($request->validated()['user_id']);
        $product->user()->associate($user);

        $product->categories()->detach();
        $product->materials()->detach();

        $product->categories()->attach($request->validated()['categories_ids']);
        $product->materials()->attach($request->validated()['materials_ids']);

        $pmodelName = $request->validated()['pmodel_name'];
        if (!empty($pmodelName)) {
            $pModel = Pmodel::firstOrCreate(['pmodel_name' => $pmodelName]);
            $product->pmodel()->associate($pModel);
        }
        if ($request->has('image_ids')) {
            $imageIds = $request->validated()['image_ids'];
            foreach ($imageIds as $imageId) {
                $image = Image::find($imageId);
                if ($image) {
                    $product->images()->attach($image->id);
                }
            }
        }

        return $product->load(['categories', 'materials', 'pmodel', 'user']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        if ($product) {
            $product->delete($product);
        }
    }

    public function searchByCatergories($categoryId)
    {

        $products = Product::whereHas('categories', function (Builder $query) use ($categoryId) {
            $query->where('category_name', $categoryId);
        })->get();

        return $products;
    }
}
