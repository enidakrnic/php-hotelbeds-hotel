<?php

namespace Redzjovi\HotelbedsHotel\Responses\Types\FacilityGroups;

use Redzjovi\HotelbedsHotel\Entities\AuditData;
use Redzjovi\HotelbedsHotel\Entities\FacilityGroup;
use Redzjovi\HotelbedsHotel\Entities\Error;

class IndexResponse
{
    public $auditData;

    /**
     * @var null|Error
     **/
    public $error = null;

    /**
     * @var FacilityGroup[]
     **/
    public $facilityGroups = [];

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

        if (isset($data['facilityGroups']) && is_array($data['facilityGroups'])) {
            foreach ($data['facilityGroups'] as $facilityGroup) {
                $this->facilityGroups[] = new FacilityGroup($facilityGroup);
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
