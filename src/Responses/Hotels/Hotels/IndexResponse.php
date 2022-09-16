<?php

namespace Redzjovi\HotelbedsHotel\Responses\Hotels\Hotels;

use Redzjovi\HotelbedsHotel\Entities\AuditData;
use Redzjovi\HotelbedsHotel\Entities\Error;
use Redzjovi\HotelbedsHotel\Entities\Hotel;

class IndexResponse
{
    public $auditData;

    /**
     * @var null|Error
     **/
    public $error = null;

    public $from;

    /**
     * @var Hotel[]
     **/
    public $hotels = [];

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

        $this->from = intval($data['from']);
        
        if (isset($data['hotels']) && is_array($data['hotels'])) {
            foreach ($data['hotels'] as $hotel) {
                $this->hotels[] = new Hotel($hotel);
            }
        }

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
