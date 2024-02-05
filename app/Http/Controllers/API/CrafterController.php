<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCrafterRequest;
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
    public function store(StoreCrafterRequest $request)
    {
        $crafter = Crafter::create($request->validated());
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
    public function update(StoreCrafterRequest $request, Crafter $crafter)
    {
        if($crafter){
            $crafter->update($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Crafter $crafter)
    {
        if($crafter){
            $crafter->delete($crafter);
        }
    }
}
