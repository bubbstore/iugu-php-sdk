<?php

namespace bubbstore\Iugu\Contracts;

interface InvoiceInterface
{
    public function create(array $params);
    public function capture($id);
    public function find($id);
    public function refund($id);
    public function cancel($id);
}
