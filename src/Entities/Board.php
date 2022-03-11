<?php

namespace Redzjovi\HotelbedsHotel\Entities;

class Board
{
    public $code;

    public $description;

    /**
     * @var null|string
     */
    public $multiLingualCode = null;

    /**
     * @param array $data
     */
    public function __construct($data)
    {
        $this->code = strval($data['code']);
        $this->description = new Content($data['description']);

        if (isset($data['multiLingualCode'])) {
            $this->multiLingualCode = strval($data['multiLingualCode']);
        }
    }
}
