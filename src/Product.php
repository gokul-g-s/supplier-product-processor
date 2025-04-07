<?php

namespace App;

class Product
{
    public $make, $model, $colour, $capacity, $network, $grade, $condition;

    public function __construct(array $data)
    {
        $required = ['make', 'model'];

        foreach ($required as $field) {
            if (empty($data[$field])) {
                throw new \Exception("Missing required field: $field");
            }
        }

        $this->make      = $data['make'];
        $this->model     = $data['model'];
        $this->colour    = $data['colour'] ?? '';
        $this->capacity  = $data['capacity'] ?? '';
        $this->network   = $data['network'] ?? '';
        $this->grade     = $data['grade'] ?? '';
        $this->condition = $data['condition'] ?? '';
    }

    public function getKey()
    {
        return implode('|', [
            $this->make, $this->model, $this->colour, $this->capacity,
            $this->network, $this->grade, $this->condition
        ]);
    }

    public function __toString()
    {
        return json_encode(get_object_vars($this), JSON_PRETTY_PRINT);
    }
}
