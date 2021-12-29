<?php

namespace App\Services;

use App\Repositories\Contracts\{
    ProductRepositoryInterface,
    TenantRepositoryInterface
};

class ProductService
{
    protected $productRepository, $tenantRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        TenantRepositoryInterface $tenantRepository
    ) {
        $this->productRepository = $productRepository;
        $this->tenantRepository = $tenantRepository;
    }

    public function getProductsByTenantUuid(string $uuid, array $categories)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $this->productRepository->getProductsByTenanId($tenant->id, $categories);
    }

    public function getProductsByFlag(string $flag)
    {
        return $this->productRepository->getProductsByFlag($flag);
    }
}
