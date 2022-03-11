<?php

namespace RedzJovi\HotelbedsHotel\Tests;

use PHPUnit\Framework\TestCase;
use RedzJovi\HotelbedsHotel\Client;
use Redzjovi\HotelbedsHotel\Requests\Types\Languages\IndexRequest as TypesLanguagesIndexRequest;

class ExpediaRapidClientTest extends TestCase
{
    private function getClient()
    {
        return new Client(
            getenv('HOTELBEDS_HOTEL_API_KEY'),
            getenv('HOTELBEDS_HOTEL_SECRET'),
            getenv('HOTELBEDS_HOTEL_ENVIRONMENT')
        );
    }

    /**
     * @group types
     */
    public function test_get_languages()
    {
        $response = $this->getClient()->getLanguages(new TypesLanguagesIndexRequest());

        $this->assertNotEmpty($response);
    }
}
