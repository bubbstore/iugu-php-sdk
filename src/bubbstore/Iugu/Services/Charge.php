<?php

namespace bubbstore\Iugu\Services;

use bubbstore\Iugu\Contracts\ChargeInterface;

class Charge extends BaseRequest implements ChargeInterface
{
    public function __construct($http, $iugu)
    {
        parent::__construct($http, $iugu);
    }

    /**
     * create
     *
     * Cria uma nova cobrança.
     *
     * @param array $params
     * @return array
     */
    public function create(array $params)
    {
        $this->setParams($params)->sendApiRequest('POST', 'charge');

        return $this->fetchResponse();
    }
}
