<?php

class UsersValidator
{
    private $data;
    private $errors = [];
    private $fieldsRequired = ['name', 'cpf', 'birth'];
    private $fieldsNumeric = ['phone', 'cpf'];
    private $fieldsDate = ['birth'];

    public function __construct($post_data)
    {
        $this->data = $post_data;
    }

    public function validateData()
    {
        foreach ($this->fieldsRequired as $field) {
            if(!array_key_exists($field, $this->data) || (array_key_exists($field, $this->data) && empty($this->data[$field]))){
                throw new Exception("user $field is required", 422);
            }
        }

        foreach ($this->fieldsNumeric as $field) {
            if(!is_numeric($this->data[$field])){
                throw new Exception("user $field is not valid", 422);
            }
        }

        foreach ($this->fieldsDate as $field) {
            if(!DateTime::createFromFormat('Y-m-d', $this->data[$field]) ){
                throw new Exception("user $field is not valid", 422);
            }
        }

        $newData = [];

        foreach ($this->data as $key => $value) {
            $newData[$key] = "'$value'";
        }

        return $newData;
    }
}