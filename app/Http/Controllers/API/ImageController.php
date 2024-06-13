<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImageRequest;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Image::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImageRequest $request)
    {
        $validatedData = $request->validated();
        unset($validatedData['image']);
        $image = Image::create($validatedData);

        if ($request->file('image')) {
            $imagePath = $request->file('image')->store('img', 'public');
            $imageName = basename($imagePath);
            $image = new Image();
            $image->file_name = $imageName;
            $image->file_size = 1;
        }
        return $image;
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        return $image;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreImageRequest $request, Image $image)
    {
        if ($image){
            $image->update($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        if ($image){
            $image->delete($image);
        }
    }
}
