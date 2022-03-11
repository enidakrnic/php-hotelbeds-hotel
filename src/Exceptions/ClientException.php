<?php

namespace RedzJovi\HotelbedsHotel\Exceptions;

use Exception;
use Redzjovi\HotelbedsHotel\Entities\Error;

class ClientException extends Exception
{
    /**
     * @var string|Error
     */
    public $error;

    /**
     * @param array $data
     */
    public function fromData($data)
    {
        if (isset($data['error']) && is_string($data['error'])) {
            $this->error = strval($data['error']);
            $this->message = strval($data['error']);
        }

        if (isset($data['error']) && is_array($data['error'])) {
            $this->error = new Error($data['error']);
        }

        if (is_string($this->error)) {
            $this->message = $this->error;
        } elseif ($this->error instanceof Error) {
            $this->message = $this->error->message;
        }
    }
}
