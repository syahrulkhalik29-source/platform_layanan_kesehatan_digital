<?php

namespace App\Contracts;

interface ResepObatContract
{
    public function getAllByUserId($userId);
    public function storeData(array $data);
}