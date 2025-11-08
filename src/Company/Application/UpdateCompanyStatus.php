<?php

namespace OptimaCultura\Company\Application;

use OptimaCultura\Company\Domain\CompanyRepositoryInterface;
use OptimaCultura\Company\Domain\ValueObject\CompanyId;
use OptimaCultura\Company\Domain\ValueObject\CompanyStatus;

class UpdateCompanyStatus
{
    private CompanyRepositoryInterface $repository;

    public function __construct(CompanyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(string $id, string $newStatus): void
    {
        $companyId = new CompanyId($id);
        $status = new CompanyStatus($newStatus);
        
        $this->repository->updateStatus($companyId, $status);
    }
}