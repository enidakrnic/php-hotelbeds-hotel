<?php

namespace RedzJovi\HotelbedsHotel;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use RedzJovi\HotelbedsHotel\Enums\Environment;
use RedzJovi\HotelbedsHotel\Exceptions\ClientException;
use Redzjovi\HotelbedsHotel\Requests\Types\Accommodations\IndexRequest as TypesAccommodationsIndexRequest;
use Redzjovi\HotelbedsHotel\Requests\Types\Boards\IndexRequest as TypesBoardsIndexRequest;
use Redzjovi\HotelbedsHotel\Requests\Types\Categories\IndexRequest as TypesCategoriesIndexRequest;
use Redzjovi\HotelbedsHotel\Requests\Types\Chains\IndexRequest as TypesChainsIndexRequest;
use Redzjovi\HotelbedsHotel\Requests\Types\Classifications\IndexRequest as TypesClassificationsIndexRequest;
use Redzjovi\HotelbedsHotel\Requests\Types\Currencies\IndexRequest as TypesCurrenciesIndexRequest;
use Redzjovi\HotelbedsHotel\Requests\Types\Facilities\IndexRequest as TypesFacilitiesIndexRequest;
use Redzjovi\HotelbedsHotel\Requests\Types\Languages\IndexRequest as TypesLanguagesIndexRequest;
use Redzjovi\HotelbedsHotel\Responses\Types\Accommodations\IndexResponse as TypesAccommodationsIndexResponse;
use Redzjovi\HotelbedsHotel\Responses\Types\Boards\IndexResponse as TypesBoardsIndexResponse;
use Redzjovi\HotelbedsHotel\Responses\Types\Categories\IndexResponse as TypesCategoriesIndexResponse;
use Redzjovi\HotelbedsHotel\Responses\Types\Chains\IndexResponse as TypesChainsIndexResponse;
use Redzjovi\HotelbedsHotel\Responses\Types\Classifications\IndexResponse as TypesClassificationsIndexResponse;
use Redzjovi\HotelbedsHotel\Responses\Types\Currencies\IndexResponse as TypesCurrenciesIndexResponse;
use Redzjovi\HotelbedsHotel\Responses\Types\Facilities\IndexResponse as TypesFacilitiesIndexResponse;
use Redzjovi\HotelbedsHotel\Responses\Types\Languages\IndexResponse as TypesLanguagesIndexResponse;

class Client
{
    private $apiKey;

    private $environment;

    private $secret;

    private $version = '1.0';

    /**
     * @param string $apiKey
     * @param string $secret
     * @param Environment::* $environment
     */
    public function __construct(
        $apiKey,
        $secret,
        $environment
    )
    {
        $this->apiKey = $apiKey;
        $this->secret = $secret;
        $this->environment = $environment;
    }

    /**
     * @param TypesAccommodationsIndexRequest $request
     * @return TypesAccommodationsIndexResponse
     * @throws ClientException
     */
    public function getAccommodations($request)
    {
        try {
            $httpClientResponse = $this->getHttpClient()->get(
                $this->getEndpoint().'/hotel-content-api/'.$this->version.'/types/accommodations',
                [
                    'headers' => $request->toHeaders($this->getHeaders()),
                    'query' => $request->toQueries()
                ]
            );

            $contents = json_decode($httpClientResponse->getBody()->getContents(), true);

            return new TypesAccommodationsIndexResponse($contents);
        } catch (RequestException $requestException) {
            throw $this->requestExceptionToClientException($requestException);
        }
    }

    /**
     * @param TypesBoardsIndexRequest $request
     * @return TypesBoardsIndexResponse
     * @throws ClientException
     */
    public function getBoards($request)
    {
        try {
            $httpClientResponse = $this->getHttpClient()->get(
                $this->getEndpoint().'/hotel-content-api/'.$this->version.'/types/boards',
                [
                    'headers' => $request->toHeaders($this->getHeaders()),
                    'query' => $request->toQueries()
                ]
            );

            $contents = json_decode($httpClientResponse->getBody()->getContents(), true);

            return new TypesBoardsIndexResponse($contents);
        } catch (RequestException $requestException) {
            throw $this->requestExceptionToClientException($requestException);
        }
    }

    /**
     * @param TypesCategoriesIndexRequest $request
     * @return TypesCategoriesIndexResponse
     * @throws ClientException
     */
    public function getCategories($request)
    {
        try {
            $httpClientResponse = $this->getHttpClient()->get(
                $this->getEndpoint().'/hotel-content-api/'.$this->version.'/types/categories',
                [
                    'headers' => $request->toHeaders($this->getHeaders()),
                    'query' => $request->toQueries()
                ]
            );

            $contents = json_decode($httpClientResponse->getBody()->getContents(), true);

            return new TypesCategoriesIndexResponse($contents);
        } catch (RequestException $requestException) {
            throw $this->requestExceptionToClientException($requestException);
        }
    }

    /**
     * @param TypesChainsIndexRequest $request
     * @return TypesChainsIndexResponse
     * @throws ClientException
     */
    public function getChains($request)
    {
        try {
            $httpClientResponse = $this->getHttpClient()->get(
                $this->getEndpoint().'/hotel-content-api/'.$this->version.'/types/chains',
                [
                    'headers' => $request->toHeaders($this->getHeaders()),
                    'query' => $request->toQueries()
                ]
            );

            $contents = json_decode($httpClientResponse->getBody()->getContents(), true);

            return new TypesChainsIndexResponse($contents);
        } catch (RequestException $requestException) {
            throw $this->requestExceptionToClientException($requestException);
        }
    }

    /**
     * @param TypesClassificationsIndexRequest $request
     * @return TypesClassificationsIndexResponse
     * @throws ClientException
     */
    public function getClassifications($request)
    {
        try {
            $httpClientResponse = $this->getHttpClient()->get(
                $this->getEndpoint().'/hotel-content-api/'.$this->version.'/types/classifications',
                [
                    'headers' => $request->toHeaders($this->getHeaders()),
                    'query' => $request->toQueries()
                ]
            );

            $contents = json_decode($httpClientResponse->getBody()->getContents(), true);

            return new TypesClassificationsIndexResponse($contents);
        } catch (RequestException $requestException) {
            throw $this->requestExceptionToClientException($requestException);
        }
    }

    /**
     * @param TypesCurrenciesIndexRequest $request
     * @return TypesCurrenciesIndexResponse
     * @throws ClientException
     */
    public function getCurrencies($request)
    {
        try {
            $httpClientResponse = $this->getHttpClient()->get(
                $this->getEndpoint().'/hotel-content-api/'.$this->version.'/types/currencies',
                [
                    'headers' => $request->toHeaders($this->getHeaders()),
                    'query' => $request->toQueries()
                ]
            );

            $contents = json_decode($httpClientResponse->getBody()->getContents(), true);

            return new TypesCurrenciesIndexResponse($contents);
        } catch (RequestException $requestException) {
            throw $this->requestExceptionToClientException($requestException);
        }
    }

    private function getEndpoint()
    {
        if ($this->environment === Environment::PRODUCTION) {
            return 'https://api.hotelbeds.com';
        }

        return 'https://api.test.hotelbeds.com';
    }

    /**
     * @param TypesFacilitiesIndexRequest $request
     * @return TypesFacilitiesIndexResponse
     * @throws ClientException
     */
    public function getFacilities($request)
    {
        try {
            $httpClientResponse = $this->getHttpClient()->get(
                $this->getEndpoint().'/hotel-content-api/'.$this->version.'/types/facilities',
                [
                    'headers' => $request->toHeaders($this->getHeaders()),
                    'query' => $request->toQueries()
                ]
            );

            $contents = json_decode($httpClientResponse->getBody()->getContents(), true);

            return new TypesFacilitiesIndexResponse($contents);
        } catch (RequestException $requestException) {
            throw $this->requestExceptionToClientException($requestException);
        }
    }

    private function getHeaders()
    {
        return [
            'Api-key' => $this->apiKey,
            'X-Signature' => $this->getSignature()
        ];
    }

    private function getHttpClient()
    {
        return new GuzzleHttpClient();
    }

    /**
     * @param TypesLanguagesIndexRequest $request
     * @return TypesLanguagesIndexResponse
     * @throws ClientException
     */
    public function getLanguages($request)
    {
        try {
            $httpClientResponse = $this->getHttpClient()->get(
                $this->getEndpoint().'/hotel-content-api/'.$this->version.'/types/languages',
                [
                    'headers' => $request->toHeaders($this->getHeaders()),
                    'query' => $request->toQueries()
                ]
            );

            $contents = json_decode($httpClientResponse->getBody()->getContents(), true);

            return new TypesLanguagesIndexResponse($contents);
        } catch (RequestException $requestException) {
            throw $this->requestExceptionToClientException($requestException);
        }
    }

    private function getSignature()
    {
        return hash('sha256', $this->apiKey.$this->secret.time());
    }

    /**
     * @param RequestException $requestException
     * @return ClientException $clientException
     */
    private function requestExceptionToClientException($requestException)
    {
        $clientException = new ClientException($requestException->getMessage(), $requestException->getCode());

        if ($clientResponse = $requestException->getResponse()) {
            $contents = json_decode($clientResponse->getBody()->getContents(), true);
            $clientException->fromData($contents);
        }

        return $clientException;
    }
}
