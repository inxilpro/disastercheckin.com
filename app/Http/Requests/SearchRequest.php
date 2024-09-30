<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Propaganistas\LaravelPhone\PhoneNumber as LaravelPhoneNumber;

class SearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'phone_number' => [
                'required',
                'string',
                'phone:US',
            ],
        ];
    }

    protected function passedValidation()
    {
        $this->merge([
            'phone_number' => (new LaravelPhoneNumber($this->input('phone_number'), 'US'))->formatE164(),
        ]);
    }
}
