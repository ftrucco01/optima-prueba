<?php

namespace Tests\OptimaCultura\Company\Infrastructure;

use OptimaCultura\Company\Domain\Company;
use OptimaCultura\Company\Domain\CompanyRepositoryInterface;
use OptimaCultura\Company\Domain\ValueObject\CompanyId;
use OptimaCultura\Company\Domain\ValueObject\CompanyStatus;

class CompanyRepositoryFake implements CompanyRepositoryInterface
{
    public bool $callMethodCreate = false;
    public bool $callMethodUpdateStatus = false;

    /**
     * @inheritdoc
     */
    public function create(Company $company): void
    {
        $this->callMethodCreate = true;
    }

    public function updateStatus(CompanyId $id, CompanyStatus $status): void
    {
        $this->callMethodUpdateStatus = true;
    }

    public function all(): array
    {
        return [];
    }
}
