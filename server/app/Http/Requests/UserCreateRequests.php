<?php


namespace App\Http\Requests;

use Lib\Http\FormRequestInterface;

class UserCreateRequests implements FormRequestInterface
{

    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:6'],
            'email' => ['required', 'email'],
            'file' => ['string', 'min:5'],
        ];
    }

    public function messages()
    {
        return [];
    }
}