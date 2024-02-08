<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'user_id' => 'required|max:255',
            'pmodel_name' => 'nullable|max:255|exists:pmodels,pmodel_name',
            'unit_price' => 'required',
            'name' => 'required|unique:products|max:255',
            'description' => 'required|unique:products|max:255',
            'status' => 'required',
            'color' => 'required|max:255',
            'customizable' => 'nullable',
            'is_active' => 'required',
            'categories_ids' => 'required',
            'materials_ids' => 'required'
        ];
    }
}
