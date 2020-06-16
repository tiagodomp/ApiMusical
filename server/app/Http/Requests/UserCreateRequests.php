<?php


namespace App\Http\Requests;

use Lib\Http\FormRequestInterface;

class UserCreateRequests extends FormRequestInterface
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
            'file' => ['string', 'min:6', 'path:'.img_path()],
        ];
    }

    public function messages()
    {
        // TODO: Implement messages() method.
    }
}