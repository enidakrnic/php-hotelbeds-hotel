<?php

namespace Redzjovi\HotelbedsHotel\Entities;

class State
{
    public $code;

    public $name;

    /**
     * @param array $data
     */
    public function __construct($data)
    {
        $this->code = strval($data['code']);
        $this->name = strval($data['name']);
    }
}
