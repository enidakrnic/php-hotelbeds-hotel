<?php

namespace Redzjovi\HotelbedsHotel\Entities;

class Chain
{
    public $code;

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

        if (isset($data['description'])) {
            $this->description = new Content($data['description']);
        }
    }
}
