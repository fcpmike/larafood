<?php

namespace App\Services;

use App\Repositories\Contracts\{
    CategoryRepositoryInterface,
    TenantRepositoryInterface,
};

class CategoryService
{

    protected $categoryRepository, $tenantRepository;

    public function __construct(
        TenantRepositoryInterface $tenantRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->tenantRepository = $tenantRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategoriesByUuid(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $this->categoryRepository->getCategoriesByTenanId($tenant->id);
    }

    public function getCategoryByUrl(string $url)
    {
        return $this->categoryRepository->getCategoryByUrl($url);
    }
}
