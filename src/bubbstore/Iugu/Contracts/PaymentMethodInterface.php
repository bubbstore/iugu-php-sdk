<?php

namespace bubbstore\Iugu\Contracts;

interface PaymentMethodInterface
{
    public function create($customerId, array $params);
    public function update($customerId, $id, array $params);
    public function find($customerId, $id);
    public function delete($customerId, $id);
}
