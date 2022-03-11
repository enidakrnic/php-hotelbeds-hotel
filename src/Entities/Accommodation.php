<?php

namespace Redzjovi\HotelbedsHotel\Entities;

class Accommodation
{
    public $code;

    public $typeDescription;

    public $typeMultiDescription;

    /**
     * @param array $data
     */
    public function __construct($data)
    {
        $this->code = strval($data['code']);
        $this->typeDescription = strval($data['typeDescription']);
        $this->typeMultiDescription = new Content($data['typeMultiDescription']);
    }
}
