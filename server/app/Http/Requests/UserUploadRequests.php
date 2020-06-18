<?php


namespace App\Http\Requests;

use Lib\Http\FormRequestInterface;

class UserUploadRequests implements FormRequestInterface
{

    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'name' => ['string', 'min:6'],
            'email' => ['email'],
            'file' => ['string', 'min:5'],
        ];
    }

    public function messages()
    {
        return [];
    }
}