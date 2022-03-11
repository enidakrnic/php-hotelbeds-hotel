<?php

namespace Redzjovi\HotelbedsHotel\Entities;

class AuditData
{
    public $environment;

    public $processTime;

    public $release;

    public $requestHost;

    public $serverId;

    public $timestamp;

    /**
     * @param array $data
     */
    public function __construct($data)
    {
        $this->environment = strval($data['environment']);
        $this->processTime = strval($data['processTime']);
        $this->release = strval($data['release']);
        $this->requestHost = strval($data['requestHost']);
        $this->serverId = strval($data['serverId']);
        $this->timestamp = strval($data['timestamp']);
    }
}
