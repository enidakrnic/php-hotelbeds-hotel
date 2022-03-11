<?php

namespace RedzJovi\HotelbedsHotel;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use RedzJovi\HotelbedsHotel\Enums\Environment;
use RedzJovi\HotelbedsHotel\Exceptions\ClientException;
use Redzjovi\HotelbedsHotel\Requests\Types\Languages\IndexRequest as TypesLanguagesIndexRequest;
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

    private function getEndpoint()
    {
        if ($this->environment === Environment::PRODUCTION) {
            return 'https://api.hotelbeds.com';
        }

        return 'https://api.test.hotelbeds.com';
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
