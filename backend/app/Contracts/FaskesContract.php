<?php

namespace App\Contracts;

interface FaskesContract
{
    public function getAll();
    public function storeData(array $data);
}