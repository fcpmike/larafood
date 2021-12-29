<?php

namespace App\Repositories\Contracts;

interface CategoryRepositoryInterface
{
    public function getCategoriesByTenantUuid(string $uuid);
    public function getCategoriesByTenanId(int $idTenant);
    public function getCategoryByUrl(string $url);
}
