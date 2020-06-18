<?php

namespace Lib\Middleware\FormRequest;

trait FormsValidate
{
    public function min($rule, $value)
    {
        return count($value) > $rule;
    }
    
    public function max($rule, $value)
    {
        return count($value) < $rule;
    }
    
    public function string($rule, $value)
    {
        return is_string($value) == $rule;
    }

    public function int($rule, $value)
    {
        return is_int($value) == $rule;
    }

    public function bool($rule, $value)
    {
        return is_bool($value) == $rule;
    }

    public function email($rule, $value)
    {
        return is_email($value) == $rule;
    }

    public function path($rule, $value)
    {
        return file_exists($value);
    }

    public function regex($rule, $value)
    {
        $match = preg_match($rule, $value);
        return  $match !== false && $match >= 1;
    }

    public function required($rule, $value)
    {
        return !empty($value) == $rule;
    }
}