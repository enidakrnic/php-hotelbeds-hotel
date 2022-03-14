<?php

namespace Redzjovi\HotelbedsHotel\Responses\Types\Facilities;

use Redzjovi\HotelbedsHotel\Entities\AuditData;
use Redzjovi\HotelbedsHotel\Entities\Facility;
use Redzjovi\HotelbedsHotel\Entities\Error;

class IndexResponse
{
    public $auditData;

    /**
     * @var null|Error
     **/
    public $error = null;

    /**
     * @var Facility[]
     **/
    public $facilities = [];

    public $from;

    public $to;

    public $total;

    /**
     * @param array $data
     */
    public function __construct($data)
    {
        $this->auditData = new AuditData($data['auditData']);

        if (isset($data['error'])) {
            $this->error = new Error($data['error']);
        }

        if (isset($data['facilities']) && is_array($data['facilities'])) {
            foreach ($data['facilities'] as $facility) {
                $this->facilities[] = new Facility($facility);
            }
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
