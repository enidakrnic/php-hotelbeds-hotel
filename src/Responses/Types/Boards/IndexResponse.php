<?php

namespace Redzjovi\HotelbedsHotel\Responses\Types\Boards;

use Redzjovi\HotelbedsHotel\Entities\AuditData;
use Redzjovi\HotelbedsHotel\Entities\Board;
use Redzjovi\HotelbedsHotel\Entities\Error;

class IndexResponse
{
    public $auditData;

    /**
     * @var Board[]
     **/
    public $boards = [];

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
        $this->auditData = new AuditData($data['auditData']);

        if (isset($data['boards']) && is_array($data['boards'])) {
            foreach ($data['boards'] as $board) {
                $this->boards[] = new Board($board);
            }
        }

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
