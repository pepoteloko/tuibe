<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'from' => 'required',
            'to' => 'required',
            'departure' => 'date',
            'return' => 'date',
            'adults' => 'numeric|min:0',
            'children' => 'numeric|min:0',
            'babies' => 'numeric|min:0',
        ];
    }
}
