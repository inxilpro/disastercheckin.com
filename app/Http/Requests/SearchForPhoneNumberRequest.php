<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchForPhoneNumberRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'phone_number' => [
                'required',
                'phone:US',
            ]
        ];
    }
}
