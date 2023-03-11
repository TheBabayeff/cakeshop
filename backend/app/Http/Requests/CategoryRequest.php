<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
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
                    'name'        => ['required', 'string', 'max:100', Rule::unique('categories', 'name')],
                    'slug'        => ['required', 'string', 'max:100', Rule::unique('categories', 'slug')],
                    'description' => ['nullable', 'string', 'max:500'],
                    'image'       => ['required', 'max:5120', 'mimes:png,jpg'],
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name'        => ['required', 'string', 'max:100', Rule::unique('categories', 'name')->ignore($this->category->id)],
                    'slug'        => ['required', 'string', 'max:100', Rule::unique('categories', 'slug')->ignore($this->category->id)],
                    'description' => ['nullable', 'string', 'max:500'],
                    'image'       => ['sometimes', 'max:5120', 'mimes:png,jpg'],
                ];
            }
            default:
                break;
        }
    }
}
