<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubscribeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => [
                'nullable',
                'integer',
                Rule::exists('packages', 'id')->where(function ($query) {
                    $query->where('name', $this->input('package'));
                }),
            ],
            'package' => [
                'required',
                'string',
                Rule::exists('packages', 'name')->where(function ($query) {
                    $query->where('id', $this->input('id'));
                }),
            ],
            'phone' => [
                'required',
                'string',
                'regex:/^(2547\d{8}|07\d{8})$/'
            ],
        ];
    }

    public function messages()
    {
        return [
            'id.exists' => 'The selected package ID and name must match.',
            'package.exists' => 'The selected package ID and name must match.',
            'phone.regex' => 'The phone number must be in the format 2547******** or 07********* with no text.',
        ];
    }
}
