<?php

namespace Redzjovi\HotelbedsHotel\Responses\Types\Issues;

use Redzjovi\HotelbedsHotel\Entities\AuditData;
use Redzjovi\HotelbedsHotel\Entities\Issue;
use Redzjovi\HotelbedsHotel\Entities\Error;

class IndexResponse
{
    public $auditData;

    /**
     * @var null|Error
     **/
    public $error = null;

    public $from;

    /**
     * @var Issue[]
     **/
    public $issues = [];

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
        
        if (isset($data['issues']) && is_array($data['issues'])) {
            foreach ($data['issues'] as $issue) {
                $this->issues[] = new Issue($issue);
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
