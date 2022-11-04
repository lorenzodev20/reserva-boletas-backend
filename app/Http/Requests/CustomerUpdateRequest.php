<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
            //'identification' => 'required|unique:customers|max:50|'.$this->route('customer')->id,
        return [
            'first_name' => 'string|required|max:100',
            'last_name' => 'string|required|max:100',
            'phone_number' => 'string'
        ];
    }
}
