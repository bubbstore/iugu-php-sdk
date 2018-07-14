<?php

namespace bubbstore\Iugu\Services;

use bubbstore\Iugu\TestCase;
use bubbstore\Iugu\Iugu;
use bubbstore\Iugu\Exceptions\IuguException;
use bubbstore\Iugu\Exceptions\IuguValidationException;

class ChargeTest extends TestCase
{

    /**
     * @var \bubbstore\RDStation\Iugu
     */
    protected $iugu;

    public function setUp()
    {
        parent::setUp();

        $this->iugu = new Iugu(
            'TOKEN'
        );
    }

    public function test_charge_boleto()
    {
        $body = __DIR__.'/../ResponseSamples/Charges/ChargeCreated.json';
        $http = $this->mockHttpClient($body);

        $charge = new Charge($http, $this->iugu);
        $charge = $charge->create([
            'method' => 'bank_slip',
            'email' => 'lucas@bubb.com.br',
            'order_id' => uniqid(),
            'payer' => [
                'cpf_cnpj' => '65634052076',
                'name' => 'Lucas Colette',
                'phone_prefix' => '11',
                'phone' => '11111111',
                'email' => 'lucas@bubb.com.br',
                'address' => [
                    'street' => 'Foo Bar',
                    'number' => '123',
                    'district' => 'Foo',
                    'city' => 'Foo',
                    'state' => 'SP',
                    'zip_code' => '14940000',
                ],
            ],
            'items' => [
                [
                    'description' => 'Item 1',
                    'quantity' => 1,
                    'price_cents' => 1000
                ],
                [
                    'description' => 'Item 2',
                    'quantity' => 2,
                    'price_cents' => 2000
                ],
            ],
        ]);

        $this->assertTrue($charge['success']);

    }

}