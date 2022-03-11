<?php

namespace RedzJovi\HotelbedsHotel\Tests;

use PHPUnit\Framework\TestCase;
use RedzJovi\HotelbedsHotel\Client;
use Redzjovi\HotelbedsHotel\Requests\Types\Accommodations\IndexRequest as TypesAccommodationsIndexRequest;
use Redzjovi\HotelbedsHotel\Requests\Types\Boards\IndexRequest as TypesBoardsIndexRequest;
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
    public function test_get_accommodations()
    {
        $response = $this->getClient()->getAccommodations(new TypesAccommodationsIndexRequest());

        $this->assertNotEmpty($response);
    }

    /**
     * @group types
     */
    public function test_get_boards()
    {
        $response = $this->getClient()->getBoards(new TypesBoardsIndexRequest());

        $this->assertNotEmpty($response);
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
