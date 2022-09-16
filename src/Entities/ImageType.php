<?php

namespace Redzjovi\HotelbedsHotel\Entities;

class ImageType
{
    public $code;

    public $description;

    /**
     * @param array $data
     */
    public function __construct($data)
    {
        $this->code = strval($data['code']);
        $this->description = new Content($data['description']);
    }
}
