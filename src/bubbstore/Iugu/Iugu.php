<?php

namespace bubbstore\Iugu;

use bubbstore\Iugu\Contracts\CustomerInterface;
use bubbstore\Iugu\Contracts\ChargeInterface;
use bubbstore\Iugu\Contracts\InvoiceInterface;
use bubbstore\Iugu\Services\Customer;
use bubbstore\Iugu\Services\Charge;
use bubbstore\Iugu\Services\Invoice;
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
     * Serviço de Cobrança
     *
     * @var \bubbstore\Iugu\Contracts\ChargeInterface
     */
    protected $charge;

    /**
     * Serviço de Fatura
     *
     * @var \bubbstore\Iugu\Contracts\InvoiceInterface
     */
    protected $invoice;

    /**
     * apiKey público
     *
     * @var string
     */
    private $apiKey;

    public function __construct(
        $apiKey,
        CustomerInterface $customer = null,
        ChargeInterface $charge = null,
        InvoiceInterface $invoice = null,
        ClientInterface $http = null
    ) {
        if (!is_string($apiKey)) {
            throw new IuguException('A API Key precisa ser uma string');
        }
        
        $this->apiKey = $apiKey;
        $this->http = $http ?: new HttpClient([
            'base_uri' => 'https://api.iugu.com/v1/',
            'headers' => [
                'Authorization' => sprintf('Basic %s', base64_encode($apiKey.':'.'')),
            ],
        ]);

        $this->customer = $customer ?: new Customer($this->http, $this);
        $this->charge = $charge ?: new Charge($this->http, $this);
        $this->invoice = $invoice ?: new Invoice($this->http, $this);
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

    /**
     * charge
     *
     * Serviço de Cliente
     *
     * @return \bubbstore\Iugu\Services\Charge
     */
    public function charge()
    {
        return $this->charge;
    }

    /**
     * invoice
     *
     * Serviço de Fatura
     *
     * @return \bubbstore\Iugu\Services\Invoice
     */
    public function invoice()
    {
        return $this->invoice;
    }
}
