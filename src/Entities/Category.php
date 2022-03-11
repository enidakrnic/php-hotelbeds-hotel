<?php

namespace Redzjovi\HotelbedsHotel\Entities;

class Category
{
    public $accommodationType;

    public $code;

    /**
     * @var null|Content
     */
    public $description = null;

    /**
     * @var null|string
     */
    public $group = null;

    public $simpleCode;

    /**
     * @param array $data
     */
    public function __construct($data)
    {
        $this->accommodationType = strval($data['accommodationType']);
        $this->code = strval($data['code']);

        if (isset($data['description'])) {
            $this->description = new Content($data['description']);
        }

        if (isset($data['group'])) {
            $this->group = strval($data['group']);
        }

        $this->simpleCode = intval($data['simpleCode']);
    }
}
