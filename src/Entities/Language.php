<?php

namespace Redzjovi\HotelbedsHotel\Entities;

class Language
{
    public $code;

    public $description;

    /**
     * @var null|string
     */
    public $name;

    /**
     * @param array $data
     */
    public function __construct($data)
    {
        $this->code = strval($data['code']);
        $this->description = new Content($data['description']);

        if (isset($data['name'])) {
            $this->name = strval($data['name']);
        }
    }
}
