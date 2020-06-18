<?php

namespace Lib\Middleware\FormRequest;

final class FormRequest
{
    use FormsValidate;

    /**
     * @var array
     */
    private $rules;

    /**
     * @var array
     */
    private $messages;

    /**
     * @var array
     */
    private $errors;

    /**
     * @var Request
     */
    private $request;

    public function __construct(FormRequestInterface $form)
    {
        if(!$form->authorize())
            return $this->error(401, 'Não autorizado');

        $config = (array) require_once config_path('formRequests.php')?:[];

        $this->rules    = $form->rules();
        $this->messages = array_merge(!empty($config['messages'])?$config['messages']:[], $form->messages());
        $this->request  = request()->all();
    }

    public function handle()
    {
        if(empty($this->rules))
            return true;

        foreach ($this->rules as $label => $rules) {
            foreach ($rules as $rule) {
                $data = (array) explode(':', $rule, 1);
                $nameRule = (string) $data[0];
                $valueRule = (!empty($data[1]))?$data[1]:true;

                //validate in trait, return boolean
                if(!$this->$nameRule($valueRule, $this->request[$label])) {
                    $msg = (string) $this->getMessage($label, $rule);
                    $this->setErrors($label, $msg);
                }
            }
        }

        return empty($this->errors);
    }

    private function setErrors($atributo, $msg)
    {
        $this->errors[$atributo] = $msg;
        return $this;
    }

    private function getMessage($atributo, $ruleName)
    {
        return str_replace( [':atributo', ':value'],
                            [$atributo, $this->request[$ruleName]],
                            $this->messages[$ruleName]);
    }

    private function error($status, $msg)
    {
        return response()->status($status)->sendMessage($msg);
    }
}