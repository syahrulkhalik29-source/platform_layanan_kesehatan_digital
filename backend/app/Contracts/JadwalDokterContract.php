<?php

namespace App\Contracts;

interface JadwalDokterContract
{
    public function getAll();
    public function storeData(array $data);
}