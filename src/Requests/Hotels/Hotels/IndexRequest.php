<?php

namespace Redzjovi\HotelbedsHotel\Requests\Hotels\Hotels;

class IndexRequest
{
    public $destinationCode;

    public $countryCode;

    public $codes;

    public $includeHotels;

    public $fields;

    public $language;

    public $from;

    public $to;

    public $useSecondaryLanguage;

    public $lastUpdateTime;

    public $accept = 'application/json';

    public $acceptEncoding = 'gzip';

    public function __construct(
        $destinationCode = '',
        $countryCode = '',
        $codes = [],
        $includeHotels = '',
        $fields = 'all',
        $language = '',
        $from = 1,
        $to = 1000,
        $useSecondaryLanguage = false,
        $lastUpdateTime = ''
    )
    {
        $this->destinationCode = $destinationCode;
        $this->countryCode = $countryCode;
        $this->codes = $codes;
        $this->includeHotels = $includeHotels;
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
            'destinationCode' => $this->destinationCode,
            'countryCode' => $this->countryCode,
            'codes' => $this->codes,
            'includeHotels' => $this->includeHotels,
            'fields' => $this->fields,
            'language' => $this->language,
            'from' => $this->from,
            'to' => $this->to,
            'useSecondaryLanguage' => $this->useSecondaryLanguage,
            'lastUpdateTime' => $this->lastUpdateTime
        ]);
    }
}
