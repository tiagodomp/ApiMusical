<?php

namespace Lib\Model;

abstract class Model
{
    protected $table;

    private $key;

    private $propertys;

    private $data;

    private $interactionData;

    public function __construct()
    {
        $this->defProperty();
        $this->defData();
    }

    public function __get($prop)
    {
        if(strStart($prop, 'get'))
            $prop = lcfirst(str_replace('get', '', $prop));

        if($this->isProperty($prop))
            return $this->propertys[$prop];

        return '';
    }

    public function __set($prop, $value)
    {
        if(strStart($prop, 'set'))
            $prop = lcfirst(str_replace('set', '', $prop));

        return $this->setProperty($prop, $value);
    }

    public function __toString()
    {
        return json_encode($this->propertys);
    }

    public function find($search)
    {
        if(is_int($search))
            return $this->findData(['id' => $search]);

        if(is_uuid($search))
            return $this->findData(['uuid' => $search]);

        if(is_string($search))
            return $this->findData(['name' => $search]);

        if(is_array($search))
            return $this->findData($search);

        return null;
    }

    public function id()
    {
        $this->id = count($this->data);
        return $this;
    }

    public function uuid()
    {
        $this->uuid = strUuid();
        return $this;
    }

    public function create(array $data){
        $save = [];

        foreach($data as $prop => $value)
            if ($this->isProperty($prop))
                $save[$prop] = $value;

        $this->data[] = $save;

        return $this;
    }

    public function save()
    {
        $this->defProperty();
        $this->data[$this->key] = array_merge($this->data[$this->key], $this->propertys);

        return $this->defJson();
    }

    private function getKey(array $data)
    {
        $prop = array_keys($data)[0];
        $this->findData([$prop, $data[$prop]]);
        if(!empty($this->interactionData))
            return (int) array_keys($this->interactionData)[0];

        return null;
    }

    private function defKey()
    {
        $prop = array_keys($this->propertys)[0];
        $this->findData([$prop, $this->propertys[$prop]]);
        $this->key = (int) array_keys($this->interactionData)[0];

        return $this;
    }

    private function isProperty($prop)
    {
        return array_key_exists($prop, $this->propertys);
    }

    private function setProperty($prop, $value)
    {
        if($this->isProperty($prop)){
            $this->propertys[$prop]             = $value;
            $this->$prop                        = $value;
        }
        return $this;
    }

    private function defProperty()
    {
        foreach(get_object_vars($this) as $prop => $val) {
            if(in_array($prop, $this->ignorePropertys()))
                continue;

            $this->propertys[$prop] = $val;
        }

        $this->defKey();
        return $this;
    }

    private function defData()
    {
        if(is_file($bd = storage_path($this->table.'.json')))
            $this->data = (array) json_decode(file_get_contents($bd), true) ?: [];

        return $this;
    }

    private function defJson()
    {
        if(is_file($bd = storage_path($this->table.'.json')))
            file_put_contents($bd, json_encode($this->data));

        return $this;
    }

    private function findData(array $search)
    {
        $this->interactionData = [];
        $prop   = (string) array_keys($search)[0];
        $value  = (string) $search[$prop];

        foreach ($this->data as $key => $data)
            if(array_key_exists($prop, $data) && $data[$prop] == $value)
                foreach($data as $prop => $value)
                    $this->interactionData[$key] = $data;

        return $this;
    }

    private function ignorePropertys()
    {
        return [
            'interactionData',
            'table',
            'propertys',
            'data',
            'key'
        ];
    }
}