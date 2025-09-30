<?php

namespace OptimaCultura\Company\Infrastructure;

use App\Models\Company as ModelsCompany;
use OptimaCultura\Company\Domain\Company;
use OptimaCultura\Company\Domain\CompanyRepositoryInterface;

class CompanyRepositoryEloquent implements CompanyRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function create(Company $company): void
    {
        ModelsCompany::Create([
            'id'     => $company->id(),
            'name'   => $company->name(),
            'status' => $company->status(),
        ]);
    }
}
