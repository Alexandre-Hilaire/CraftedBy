<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCrafterRequest;
use App\Models\Crafter;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;

class CrafterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Crafter::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCrafterRequest $request)
    {
        $user = User::findOrFail($request->validated()['user_id']);
        $crafter = $user->crafter()->create([
            'information'=>$request->validated()['information'],
            'story'=>$request->validated()['story'],
            'crafting_process'=>$request->validated()['crafting_process'],
            'material_preference'=>$request->validated()['material_preference'],
            'location'=>$request->validated()['location'],
        ]);

        if ($request->has('image_ids')){
            $imagesIds = $request->validated()['image_ids'];
            foreach ($imagesIds as $imageId){
                $image = Image::find($imageId);
                if ($image){
                    $crafter->images()->save($image);
                }
            }
        }

        return $crafter->load('users', 'images');
    }

    /**
     * Display the specified resource.
     */
    public function show(Crafter $crafter)
    {
        return $crafter->load('users', 'images');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCrafterRequest $request, Crafter $crafter)
    {
        $this->authorize('update', $crafter);
        if($crafter){
            $user = User::findOrFail($request->validated()['user_id']);
            $crafter = $user->crafter()->update([
                'information'=>$request->validated()['information'],
                'story'=>$request->validated()['story'],
                'crafting_process'=>$request->validated()['crafting_process'],
                'material_preference'=>$request->validated()['material_preference'],
                'location'=>$request->validated()['location'],
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Crafter $crafter)
    {
        $this->authorize('destroy', $crafter);
        if($crafter){
            $crafter->delete($crafter);
        }
    }
}
