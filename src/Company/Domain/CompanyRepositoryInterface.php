<?php

namespace OptimaCultura\Company\Domain;

use OptimaCultura\Company\Domain\ValueObject\CompanyId;
use OptimaCultura\Company\Domain\ValueObject\CompanyStatus;

interface CompanyRepositoryInterface
{
    /**
     * Persist a new company instance
     */
    public function create(Company $company): void;

    /**
     * Update status company method
     */
    public function updateStatus(CompanyId $id, CompanyStatus $status): void;
}
