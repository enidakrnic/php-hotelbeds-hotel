<?php

namespace Redzjovi\HotelbedsHotel\Entities;

class FacilityGroup
{
    public $code;

    public $description;

    /**
     * @param array $data
     */
    public function __construct($data)
    {
        $this->code = intval($data['code']);
        $this->description = new Content($data['description']);
    }
}
