<?php

namespace Redzjovi\HotelbedsHotel\Entities;

class Content
{
    public $content;

    /**
     * @var null|string
     */
    public $languageCode = null;

    /**
     * @param array $data
     */
    public function __construct($data)
    {
        $this->content = strval($data['content']);

        if (isset($data['languageCode'])) {
            $this->languageCode = strval($data['languageCode']);
        }
    }
}
