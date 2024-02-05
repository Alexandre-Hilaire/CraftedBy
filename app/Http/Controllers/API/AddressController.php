<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddressRequest;
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
    public function store(StoreAddressRequest $request)
    {
        $address = Address::create([
            'user_id' =>$request->get('user_id'),
            'address_name'=>$request->get('address_name'),
            'address_type'=>$request->get('address_type'),
            'address_firstname'=>$request->get('address_firstname'),
            'address_lastname'=>$request->get('address_lastname'),
            'first_address'=>$request->get('first_address'),
            'second_address'=>$request->get('second_address'),
            'postal_code'=>$request->get('postal_code'),
        ]);
        return $address;
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        return $address;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAddressRequest $request, Address $address)
    {
        if ($address){
            $address->update($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        if ($address){
            $address->delete($address);
        }
    }
}
