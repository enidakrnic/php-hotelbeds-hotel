<?php

namespace Redzjovi\HotelbedsHotel\Entities;

class Image
{
    /**
     * @var null|string
     */
    public $characteristicCode;

    public $imageTypeCode;

    public $order;

    public $path;

    /**
     * @var null|string
     */
    public $roomCode;

    /**
     * @var null|string
     */
    public $roomType;

    /**
     * @var null|ImageType
     */
    public $type;

    public $visualOrder;

    /**
     * @var null|string
     */
    public $PMSRoomCode;

    /**
     * @param array $data
     */
    public function __construct($data)
    {
        if (isset($data['characteristicCode'])) {
            $this->characteristicCode = strval($data['characteristicCode']);
        }

        $this->imageTypeCode = strval($data['imageTypeCode']);
        $this->order = intval($data['order']);
        $this->path = strval($data['path']);
        
        if (isset($data['roomCode'])) {
            $this->roomCode = strval($data['roomCode']);
        }

        if (isset($data['roomType'])) {
            $this->roomType = strval($data['roomType']);
        }

        if (isset($data['type'])) {
            $this->type = new ImageType($data['type']);
        }

        $this->visualOrder = intval($data['order']);
        
        if (isset($data['PMSRoomCode'])) {
            $this->PMSRoomCode = strval($data['PMSRoomCode']);
        }
    }
}
