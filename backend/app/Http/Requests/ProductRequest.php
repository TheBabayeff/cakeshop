<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'category_id'  => ['required', 'integer'],
                    'name'        => ['required', 'string', 'max:100', Rule::unique('products', 'name')],
                    'code'         => ['required', 'string', 'max:100', Rule::unique('products', 'code')],
                    'description' => ['nullable', 'string', 'max:500'],
                    'price'       => ['required', 'numeric', 'min:0'],
                    'image'       => ['required', 'max:5120', 'mimes:png,jpg'],
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'category_id'  => ['required', 'integer'],
                    'name'        => ['required', 'string', 'max:100', Rule::unique('products', 'name')->ignore($this->product->id)],
                    'code'         => ['required', 'string', 'max:100', Rule::unique('products', 'code')->ignore($this->product->id)],
                    'description' => ['nullable', 'string', 'max:500'],
                    'price'       => ['required', 'numeric', 'min:0'],
                    'image'       => ['sometimes', 'max:5120', 'mimes:png,jpg'],
                ];
            }
            default:
                break;
        }
    }
}
