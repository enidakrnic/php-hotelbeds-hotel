<?php

namespace Redzjovi\HotelbedsHotel\Entities;

class Facility
{
    public $code;

    /**
     * @var null|Content
     */
    public $description = null;

    public $facilityGroupCode;

    public $facilityTypologyCode;

    /**
     * @param array $data
     */
    public function __construct($data)
    {
        $this->code = intval($data['code']);

        if (isset($data['description'])) {
            $this->description = new Content($data['description']);
        }

        $this->facilityGroupCode = intval($data['facilityGroupCode']);
        $this->facilityTypologyCode = intval($data['facilityTypologyCode']);
    }
}
