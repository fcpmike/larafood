<?php

namespace App\Services;

use App\Repositories\Contracts\{
    TableRepositoryInterface,
    TenantRepositoryInterface
};

class TableService
{
    protected $tableRepository, $tenantRepository;

    public function __construct(
        TenantRepositoryInterface $tenantRepository,
        TableRepositoryInterface $tableRepository
    ) {
        $this->tenantRepository = $tenantRepository;
        $this->tableRepository = $tableRepository;
    }

    public function getTableByUuid(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $this->tableRepository->getTablesByTenanId($tenant->id);
    }

    public function getTableByIdentify(string $identify)
    {
        return $this->tableRepository->getTableByUuid($identify);
    }
}
