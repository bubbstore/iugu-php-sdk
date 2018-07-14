<?php

namespace bubbstore\Iugu;

use Mockery;
use GuzzleHttp\ClientInterface;
use bubbstore\Iugu\Services\Customer;
use bubbstore\Iugu\Contracts\CustomerInterface;

class ClientTest extends TestCase
{
    /**
     * @var \bubbstore\Iugu\Iugu
     */
    protected $iugu;

    public function setUp()
    {
        parent::setUp();

        $this->iugu = new Iugu(
            'TOKEN',
            Mockery::mock(CustomerInterface::class)
        );
    }

    public function testCustomerService()
    {
        $this->assertInstanceOf(CustomerInterface::class, $this->iugu->customer());
    }
}