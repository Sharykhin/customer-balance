<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CustomerRequest
 * @package App\Http\Requests
 */
class CustomerRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                return [
                    'email'    => 'required|email|unique:customers,email|max:255',
                    'first_name' => 'required|string|max:50',
                    'last_name' => 'required|string|max:50',
                    'gender' => 'required|string|in:female,male|max:10',
                    'country' => 'required|string|max:3'
                ];
            case 'PATCH':
                return [
                    'email'    => 'sometimes|email|unique:customers,email,'.$this->get('id').'|max:255',
                    'first_name' => 'string|max:50',
                    'last_name' => 'sometimes|string|max:50',
                    'gender' => 'sometimes|string|in:female,male|max:10',
                    'country' => 'sometimes|string|max:3'
                ];
        }
    }

    public function response(array $errors)
    {
        return response()->badRequest($errors);
    }
}
