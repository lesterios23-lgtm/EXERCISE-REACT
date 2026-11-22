<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => 'required|string|max:12|unique:product1s,code',
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'manufacturer' => 'required|string|max:100',
            'photo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'price' => 'required|numeric|between:0,99999.99',
            'cost' => 'required|numeric|between:0,99999.99',
            'inventory_quantity' => 'required|integer|min:0',
        ];
    }
}
