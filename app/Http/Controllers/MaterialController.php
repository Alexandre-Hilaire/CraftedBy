<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMaterialRequest;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Material::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaterialRequest $request)
    {
        $material = Material::create($request->validated());
        return $material;
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
        return $material;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreMaterialRequest $request, Material $material)
    {
        if ($material){
            $material->update($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        if ($material){
            $material->delete($material);
        }
    }
}
