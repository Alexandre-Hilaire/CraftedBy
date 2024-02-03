<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Address::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $adress = Address::create([
            'user_id' =>$request->get('user_id'),
            'address_name'=>$request->get('address_name'),
            'address_type'=>$request->get('address_type'),
            'address_firstname'=>$request->get('address_firstname'),
            'address_lastname'=>$request->get('address_lastname'),
            'first_address'=>$request->get('first_address'),
            'second_address'=>$request->get('second_address'),
            'postal_code'=>$request->get('postal_code'),
        ]);
        return $adress;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
