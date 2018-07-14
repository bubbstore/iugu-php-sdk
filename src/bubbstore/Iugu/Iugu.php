<?php

namespace bubbstore\Iugu;

use bubbstore\Iugu\Contracts\CustomerInterface;
use bubbstore\Iugu\Services\Customer;
use bubbstore\Iugu\Exceptions\IuguException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client as HttpClient;

class Iugu
{

    /**
     * Serviço de Cliente
     *
     * @var \bubbstore\Iugu\Contracts\CustomerInterface
     */
    protected $customer;

    /**
     * apiKey público
     *
     * @var string
     */
    private $apiKey;

    public function __construct(
        $apiKey,
        CustomerInterface $customer = null,
        ClientInterface $http = null
    ) {
        if (!is_string($apiKey)) {
            throw new IuguException('A API Key precisa ser uma string');
        }
        
        $this->apiKey = $apiKey;
        $this->http = $http ?: new HttpClient([
            'base_uri' => 'https://api.iugu.com/v1/',
            'timeout' => 2,
            'headers' => [
                'Authorization' => sprintf('Basic %s', base64_encode($apiKey.':'.'')),
            ],
        ]);

        $this->customer = $customer ?: new Customer($this->http, $this);
    }

    /**
     * customer
     *
     * Serviço de Cliente
     *
     * @return \bubbstore\Iugu\Services\Customer
     */
    public function customer()
    {
        return $this->customer;
    }
}
