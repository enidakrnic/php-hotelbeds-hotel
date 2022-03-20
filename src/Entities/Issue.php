<?php

namespace Redzjovi\HotelbedsHotel\Entities;

class Issue
{
    public $code;

    public $type;

    /**
     * @var Content|null
     */
    public $description = null;

    /**
     * @var Content|null
     */
    public $name = null;

    public $alternative;

    /**
     * @param array $data
     */
    public function __construct($data)
    {
        $this->code = strval($data['code']);
        $this->type = strval($data['type']);

        if (isset($data['description'])) {
            $this->description = new Content($data['description']);
        }

        if (isset($data['name'])) {
            $this->name = new Content($data['name']);
        }

        $this->alternative = boolval($data['alternative']);
    }
}
