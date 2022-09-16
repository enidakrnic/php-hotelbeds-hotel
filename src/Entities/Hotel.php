<?php

namespace Redzjovi\HotelbedsHotel\Entities;

class Hotel
{
    public $code;

    public $name;

    public $images;

    /**
     * @param array $data
     */
    public function __construct($data)
    {
        $this->code = intval($data['code']);
        $this->name = new Content($data['name']);

        foreach ($data['images'] as $image) {
            $this->images[] = new Image($image);
        }
    }
}
