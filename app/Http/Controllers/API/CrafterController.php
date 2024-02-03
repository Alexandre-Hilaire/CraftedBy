<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Crafter;
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
    public function store(Request $request)
    {
        $crafter = Crafter::create([
            'user_id' => $request->get('user_id'),
            'information'=> $request->get('information'),
            'story'=>$request->get('story'),
            'crafting_process'=>$request->get('crafting_process'),
            'material_preference'=>$request->get('material_preference'),
            'location' => $request->get('location'),
        ]);
        return $crafter;
    }

    /**
     * Display the specified resource.
     */
    public function show(Crafter $crafter)
    {
        return $crafter;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Crafter $crafter)
    {
        $crafter->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
