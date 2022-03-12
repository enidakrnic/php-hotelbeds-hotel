<?php

namespace Redzjovi\HotelbedsHotel\Responses\Types\Accommodations;

use Redzjovi\HotelbedsHotel\Entities\Accommodation;
use Redzjovi\HotelbedsHotel\Entities\AuditData;
use Redzjovi\HotelbedsHotel\Entities\Error;

class IndexResponse
{
    /**
     * @var Accommodation[]
     **/
    public $accommodations = [];

    public $auditData;

    /**
     * @var null|Error
     **/
    public $error = null;

    public $from;

    public $to;

    public $total;

    /**
     * @param array $data
     */
    public function __construct($data)
    {
        if (isset($data['accommodations']) && is_array($data['accommodations'])) {
            foreach ($data['accommodations'] as $accommodation) {
                $this->accommodations[] = new Accommodation($accommodation);
            }
        }

        $this->auditData = new AuditData($data['auditData']);

        if (isset($data['error'])) {
            $this->error = new Error($data['error']);
        }

        $this->from = intval($data['from']);
        $this->to = intval($data['to']);
        $this->total = intval($data['total']);
    }

    public function getNextFrom()
    {
        return $this->to + 1;
    }

    public function getNextTo()
    {
        return $this->to + 1 + ($this->to - $this->from);
    }
}
