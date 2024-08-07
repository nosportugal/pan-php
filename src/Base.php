<?php declare(strict_types=1);

namespace PAN;

use PAN\Util;

abstract class Base
{
    protected array $queryString = [];
    protected array $skipAttribute = [];

    public function __construct(array $data = [])
    {
        foreach ($data as $attribute => $value) {
            $this->setAttribute($attribute, $value);
        }
    }

    public function __set($attribute, $value)
    {
        $this->setAttribute($attribute, $value);

        // check if all attribute is valid
        $this->attributeIsValid($attribute);
    }

    protected function setAttribute($attribute, $value)
    {
        $attribute = Util::snakeToCamel($attribute);

        // check if attribute exists
        if (property_exists($this, $attribute)) {
            $setAttribute = $this->methodNameSet($attribute);

            // check if the method to set the attribute, if true it will be used
            if (method_exists($this, $setAttribute)) {
                $this->$setAttribute($value);
            } else {
                $this->$attribute = $value;
            }
        }
    }

    protected function attributesIsValid()
    {
        // get all object attributes
        $attributes = $this->attributes();

        foreach ($attributes as $attribute) {
            // check if all attribute is valid
            $this->attributeIsValid($attribute);
        }
    }

    protected function attributeIsValid($attribute)
    {
        $isRequired = $this->methodNameRequired($attribute);

        // check if attribute is required
        if ($this->$isRequired()) {
            $isValid = $this->methodNameValid($attribute);

            // if attribute is invalid it will throw an exception
            if (!$this->$isValid()) {
                $className = get_class($this);

                $message = "Error with invalid value in the {$attribute} attribute of the {$className} class!";
                throw new \Exception($message);
            }
        }
    }

    protected function methodNameSet(string $attribute): string
    {
        $attribute = ucfirst($attribute);

        return "set{$attribute}";
    }

    protected function methodNameRequired(string $attribute): string
    {
        return "{$attribute}IsRequired";
    }

    protected function methodNameValid(string $attribute): string
    {
        return "{$attribute}IsValid";
    }

    protected function attributes()
    {
        // get all object attributes
        $attributes = array_keys(get_object_vars($this));

        for ($i = 0; $i < count($attributes); $i++) {
            $required = $this->methodNameRequired($attributes[$i]);

            // check if the method required not exists to remove
            if (!method_exists($this, $required)) unset($attributes[$i]);
        }

        return $attributes;
    }

    protected function headers($token)
    {
        $headers = Util::headers([
            'bearer'       => $token,
            'content-type' => 'application/json'
        ]);

        return $headers;
    }

    protected function query(): array
    {
        $query = [];

        // get attributes not required to skip
        $skip = $this->skipAttribute;        

        $query_string = func_get_args();

        $attributes = $this->attributes();

        foreach ($attributes as $attribute) {
            // check if query string is an attribute
            if (in_array($attribute, $query_string)) {
                // skip if attribute is query string
                if (!in_array($attribute, $skip)) {                
                    // check if the attribute is required to validate data
                    $required = $this->methodNameRequired($attribute);
                    if ($this->$required()) $this->attributeIsValid($attribute);
                }

                $column = Util::camelToSnake($attribute);
                if (isset($this->$attribute)) $query[$column] = $this->$attribute;


                array_push($this->queryString, $attribute);
            }
        }

        return $query;
    }

    protected function json(): array
    {
        $json = [];

        $this->skipAttributes();

        // get attributes not required to skip
        $skipAttributes = $this->skipAttribute;

        // get atrributes from query strings to skip
        $queryString = $this->queryString;

        $skip = array_merge($skipAttributes, $queryString);

        $attributes = func_get_args();
        $attributes = count($attributes) > 0 ? $attributes : $this->attributes();

        foreach ($attributes as $attribute) {
            // skip if attribute is query string
            if (!in_array($attribute, $skip)) {
                // check if the attribute is required to validate data
                $required = $this->methodNameRequired($attribute);
                if ($this->$required()) $this->attributeIsValid($attribute);

                $column = Util::camelToSnake($attribute);
                if (isset($this->$attribute)) $json[$column] = $this->$attribute;
            }
        }

        return $json;
    }

    protected function skipAttribute(string $attribute): void
    {
        $attributes = $this->attributes();

        if (in_array($attribute, $attributes)) {
            array_push($this->skipAttribute, $attribute);
        }
    }

    protected function skipAttributes(): void
    {
        $backtraces = debug_backtrace();

        foreach ($backtraces as $backtrace) {
            $method = $backtrace['function'];

            switch ($method)
            {
                case 'create':
                    array_push($this->skipAttribute, 'id');
                    break;
            }
        }
    }
}
