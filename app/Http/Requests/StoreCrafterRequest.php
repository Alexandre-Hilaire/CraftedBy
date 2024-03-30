<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCrafterRequest extends FormRequest
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
            'crafter_name' => 'required|max:255',
            'information'=> 'required|max:500',
            'story'=> 'required|max:500',
            'crafting_process'=> 'required|max:500',
            'material_preference'=>'required|max:255',
            'location' => 'required|max:255',
            'image_ids'=>'nullable|array|exists:images,id',
        ];
    }
}
