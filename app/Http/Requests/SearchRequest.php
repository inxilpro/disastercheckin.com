<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'email' => [
                'nullable',
                'string',
                'email',
            ],
        ];
    }

    protected function passedValidation()
    {
        $phone_number = e164($this->input('phone_number'));

        $this->merge(['phone_number' => $phone_number]);
        $this->validator->setValue('phone_number', $phone_number);
    }
}
