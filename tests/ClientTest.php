<?php

namespace RedzJovi\HotelbedsHotel\Tests;

use PHPUnit\Framework\TestCase;
use RedzJovi\HotelbedsHotel\Client;
use Redzjovi\HotelbedsHotel\Requests\Types\Accommodations\IndexRequest as TypesAccommodationsIndexRequest;
use Redzjovi\HotelbedsHotel\Requests\Types\Boards\IndexRequest as TypesBoardsIndexRequest;
use Redzjovi\HotelbedsHotel\Requests\Types\Categories\IndexRequest as TypesCategoriesIndexRequest;
use Redzjovi\HotelbedsHotel\Requests\Types\Chains\IndexRequest as TypesChainsIndexRequest;
use Redzjovi\HotelbedsHotel\Requests\Types\Classifications\IndexRequest as TypesClassificationsIndexRequest;
use Redzjovi\HotelbedsHotel\Requests\Types\Currencies\IndexRequest as TypesCurrenciesIndexRequest;
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
    public function test_get_categories()
    {
        $response = $this->getClient()->getCategories(new TypesCategoriesIndexRequest());

        $this->assertNotEmpty($response);
    }

    /**
     * @group types
     */
    public function test_get_chains()
    {
        $response = $this->getClient()->getChains(new TypesChainsIndexRequest());

        $this->assertNotEmpty($response);
    }

    /**
     * @group types
     */
    public function test_get_classifications()
    {
        $response = $this->getClient()->getClassifications(new TypesClassificationsIndexRequest());

        $this->assertNotEmpty($response);
    }

    /**
     * @group types
     */
    public function test_get_currencies()
    {
        $response = $this->getClient()->getCurrencies(new TypesCurrenciesIndexRequest());

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
