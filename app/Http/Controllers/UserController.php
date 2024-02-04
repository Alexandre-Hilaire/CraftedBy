<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        $user = User::create([
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'birthdate' => $request->get('birthdate'),
            'email' => $request->get('email'),
            'role' => $request->get('role'),
            'phone_number' => $request->get('phone_number'),
            'password' => $request->get('password'),
        ]);
        return $user;
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if ($user){
            $user->update($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user){
            $user->delete($user);
        }
    }
}
