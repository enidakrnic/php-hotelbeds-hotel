<?php

namespace Redzjovi\HotelbedsHotel\Entities;

class Error
{
    public $code;

    public $message;

    /**
     * @param array $data
     */
    public function __construct($data)
    {
        $this->code = strval($data['code']);
        $this->message = strval($data['message']);
    }
}
