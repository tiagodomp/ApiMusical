<?php


namespace Lib\Http;

interface FormRequestInterface
{

    /**
     * is required authentication
     * @return bool
     */
    public function authorize();

    /**
     * rules of inputs
     * @return array
     */
    public function rules();

    /**
     * messages of output
     * @return array
     */
    public function messages();

}