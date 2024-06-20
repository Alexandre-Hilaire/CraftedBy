<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Crafter;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());

        if ($request->has('image_ids')){
            $imageIds = $request->validated()['image_ids'];
            foreach ($imageIds as $imageId) {
                $image = Image::find($imageId);
                if($image){
                    $user->images()->save($image);
                }
            }
        }

        return $user->load('images', 'addresses', 'products', 'crafter', 'orders');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $user->load('addresses', 'products', 'crafter', 'orders');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        if ($user){
            $user->update($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        if ($user){
            $user->delete($user);
        }
    }

    public function getUserRole(User $user){
        
        $userRole = '';
        // * Answer to the user model's role functions
        switch(true) {
            case $user->isAdmin():
                $userRole = 'admin';
                break;
            case $user->isCrafter():
                $userRole = 'crafter';
                break;
            case $user->isUser():
                $userRole = 'user';
                break;
        }
        return response()->json($userRole);
    }

    public function getUserCrafters(User $user) {
        $crafterPages = Crafter::where('user_id', $user->id)->get(['id', 'crafter_name']); // * get only ids and names
        return response()->json($crafterPages);
    }
}
