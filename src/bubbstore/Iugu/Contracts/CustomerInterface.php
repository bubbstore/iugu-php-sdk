<?php

namespace bubbstore\Iugu\Contracts;

interface CustomerInterface
{
    public function create(array $params);
    public function update($id, array $params);
    public function find($id);
    public function delete($id);
}
