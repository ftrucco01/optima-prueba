<?php

namespace Tests\OptimaCultura\Company\Infrastructure;

use OptimaCultura\Company\Domain\Company;
use OptimaCultura\Company\Domain\CompanyRepositoryInterface;

class CompanyRepositoryFake implements CompanyRepositoryInterface
{
    public bool $callMethodCreate = false;

    /**
     * @inheritdoc
     */
    public function create(Company $company): void
    {
        $this->callMethodCreate = true;
    }
}
