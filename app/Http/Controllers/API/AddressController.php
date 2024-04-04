<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddressRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
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
        $user = User::findOrFail($request->validated()['user_id']);

        $address = $user->addresses()->create([
            'address_name'=>$request->validated()['address_name'],
            'address_type'=>$request->validated()['address_type'],
            'address_firstname'=>$request->validated()['address_firstname'],
            'address_lastname'=>$request->validated(['address_lastname']),
            'first_address'=>$request->validated()['first_address'],
            'second_address'=>$request->validated()['second_address'],
            'postal_code'=>$request->validated()['postal_code'],
        ]);
        return $address->load('users');
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
            $user = User::findOrFail($request->validated()['user_id']);

            $address = $user->addresses()->update([
                'address_name'=>$request->validated()['address_name'],
                'address_type'=>$request->validated()['address_type'],
                'address_firstname'=>$request->validated()['address_firstname'],
                'address_lastname'=>$request->validated(['address_lastname']),
                'first_address'=>$request->validated()['first_address'],
                'second_address'=>$request->validated()['second_address'],
                'postal_code'=>$request->validated()['postal_code'],
            ]);
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
    public function getUserAddresses($userId) {
        $addresses = Address::where('user_id', $userId)->get();
        return $addresses;
    }
}
