<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePmodelRequest;
use App\Models\Pmodel;
use Illuminate\Http\Request;

class PmodelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Pmodel::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePmodelRequest $request)
    {
        $pmodel = Pmodel::create($request->validated());
        return $pmodel;
    }

    /**
     * Display the specified resource.
     */
    public function show(Pmodel $pmodel)
    {
        return $pmodel;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePmodelRequest $request, Pmodel $pmodel)
    {
        if ($pmodel){
            $pmodel->update($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pmodel $pmodel)
    {
        if ($pmodel){
            $pmodel->delete($pmodel);
        }
    }
}
