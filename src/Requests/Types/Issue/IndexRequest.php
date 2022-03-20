<?php

namespace Redzjovi\HotelbedsHotel\Requests\Types\Boards;

class IndexRequest
{
    public $fields;

    public $language;

    public $from;

    public $to;

    public $useSecondaryLanguage;

    public $lastUpdateTime;

    public $accept = 'application/json';

    public $acceptEncoding = 'gzip';

    public function __construct(
        $fields = 'all',
        $language = '',
        $from = 1,
        $to = 1000,
        $useSecondaryLanguage = false,
        $lastUpdateTime = ''
    )
    {
        $this->fields = $fields;
        $this->language = $language;
        $this->from = $from;
        $this->to = $to;
        $this->useSecondaryLanguage = $useSecondaryLanguage;
        $this->lastUpdateTime = $lastUpdateTime;
    }

    public function toHeaders($data = [])
    {
        return array_filter(array_merge(
            [
                'Accept' => $this->accept,
                'Accept-Encoding' => $this->acceptEncoding
            ],
            $data
        ));
    }

    public function toQueries()
    {
        return array_filter([
            'fields' => $this->fields,
            'language' => $this->language,
            'from' => $this->from,
            'to' => $this->to,
            'useSecondaryLanguage' => $this->useSecondaryLanguage,
            'lastUpdateTime' => $this->lastUpdateTime
        ]);
    }
}
