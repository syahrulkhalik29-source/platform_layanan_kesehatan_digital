<?php

namespace App\Contracts;

interface RekamMedisContract
{
    public function getAllByUserId($userId);
    public function storeData(array $data);
    public function deleteData($id);
}