<?php

namespace App\Repositories\Contracts;

interface TableRepositoryInterface
{
    public function getTablesByTenantUuid(string $uuid);
    public function getTablesByTenanId(int $idTenant);
    public function getTableByUuid(string $uuid);
}
