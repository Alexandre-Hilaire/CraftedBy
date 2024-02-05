<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required',
            'address_name' => 'required|max:255',
            'address_type' =>'required',
            'address_firstname'=> 'required|max:255',
            'address_lastname'=> 'required|max:255',
            'first_address' => 'required|max:255',
            'second_address' => 'required|max:255',
            'postal_code' => 'required|max:255',
        ];
    }
}