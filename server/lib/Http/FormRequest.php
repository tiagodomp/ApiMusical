<?php


namespace Lib\Http;



final class FormRequest
{
    private $rules;

    private $messages;

    public function __construct(FormRequestInterface $form)
    {
        if(!$form->authorize())
            return $this->error(401, 'Não autorizado');

        $rules = $this->rules();

    }

    private function error($status, $msg)
    {
        return response()->status($status)
                    ->toJson(is_array($msg)?$msg:['msg' => $msg])
                    ->render();
    }
}