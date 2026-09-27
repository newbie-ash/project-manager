<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
        $productId = $this->route('product') ? $this->route('product')->id : null;

        return [
            'name' => [
                'required',
                'min:4', // Tidak boleh terdiri dari 3 huruf (minimal 4)
                Rule::unique('products')->ignore($productId),
            ],
            'category' => 'required',
            'price' => 'required|numeric|gt:0', // Tidak boleh 0 atau di bawahnya
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.min' => 'The item name must be more than 3 characters.',
            'price.gt' => 'The price must be greater than 0.',
        ];
    }
}
