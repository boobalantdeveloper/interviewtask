<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
      public function rules(): array
    {
        return [
           'product_name' => 'required|max:255',
           'unit_type' => 'required',
           'category' => 'required',
           'price' => 'required',
           'discount_percentage' => 'required',
           'discount_price' => 'required',
           'taxable_percentage' => 'required',
           'taxable_amount' => 'required',
           'in_stock' => 'required',
           'stock_quantity' => 'required',
           'status' => 'required',
        ];
    }
}
