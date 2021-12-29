<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function getProductsByTenanId(int $idTenant, array $categories);
    public function getProductsByFlag(string $flag);
}
