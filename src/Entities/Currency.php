<?php

namespace Redzjovi\HotelbedsHotel\Entities;

class Currency
{
    public $code;

    public $currencyType;

    /**
     * @var null|Content
     */
    public $description = null;

    /**
     * @param array $data
     */
    public function __construct($data)
    {
        $this->code = strval($data['code']);
        $this->currencyType = strval($data['currencyType']);

        if (isset($data['description'])) {
            $this->description = new Content($data['description']);
        }
    }
}
