<?php

namespace bubbstore\Iugu\Services;

use bubbstore\Iugu\TestCase;
use bubbstore\Iugu\Iugu;
use bubbstore\Iugu\Exceptions\IuguException;
use bubbstore\Iugu\Exceptions\IuguValidationException;

class CustomerTest extends TestCase
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

    public function test_if_email_is_invalid()
    {
        $body = __DIR__.'/../ResponseSamples/Customers/InvalidCustomerEmail.json';
        $http = $this->mockHttpClient($body, 422);

        $this->expectException(IuguValidationException::class);
        $customer = new Customer($http, $this->iugu);

        $customer->create(['email' => 'foo']);
    }

    public function test_create_customer()
    {
        $body = __DIR__.'/../ResponseSamples/Customers/Customer.json';
        $http = $this->mockHttpClient($body);

        $customer = new Customer($http, $this->iugu);
        $customer = $customer->create([
            'name' => 'Nome do Cliente',
            'email' => 'email@email.com'
        ]);

        $this->assertArrayHasKey('name', $customer);
        $this->assertArrayHasKey('email', $customer);

    }

    public function test_find_customer()
    {
        $body = __DIR__.'/../ResponseSamples/Customers/Customer.json';
        $http = $this->mockHttpClient($body);

        $customer = new Customer($http, $this->iugu);
        $customer = $customer->find('77C2565F6F064A26ABED4255894224F0');

        $this->assertContains('77C2565F6F064A26ABED4255894224F0', $customer['id']);
    }

    public function test_delete_customer()
    {
        $body = __DIR__.'/../ResponseSamples/Customers/Customer.json';
        $http = $this->mockHttpClient($body);

        $customer = new Customer($http, $this->iugu);
        $customer = $customer->delete('77C2565F6F064A26ABED4255894224F0');

        $this->assertContains('77C2565F6F064A26ABED4255894224F0', $customer['id']);
    }

}