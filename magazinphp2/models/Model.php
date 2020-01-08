<?php


namespace app\models;


abstract class Model
{
    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->props[$name] = $value;
    }
}

