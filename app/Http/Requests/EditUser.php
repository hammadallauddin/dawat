<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUser extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'user_phone' => 'required|numeric',
            'banquet_phone' => 'required|numeric',
            'banquet_name' => 'required',
            'capacity' => 'required|numeric',
            'maximum_rate' => 'required|numeric',
            'minimum_rate' => 'required|numeric',
            'description' => 'required',
            'city' => 'required',
            'area' => 'required',
        ];
    }
}
