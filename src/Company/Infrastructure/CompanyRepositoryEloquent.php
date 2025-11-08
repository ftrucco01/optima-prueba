<?php

namespace OptimaCultura\Company\Infrastructure;

use App\Models\Company as EloquentCompany;
use OptimaCultura\Company\Domain\Company;
use OptimaCultura\Company\Domain\CompanyRepositoryInterface;
use OptimaCultura\Company\Domain\ValueObject\CompanyId;
use OptimaCultura\Company\Domain\ValueObject\CompanyStatus;

class CompanyRepositoryEloquent implements CompanyRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function create(Company $company): void
    {
        EloquentCompany::Create([
            'id'     => $company->id(),
            'name'   => $company->name(),
            'status' => $company->status(),
        ]);
    }

    public function updateStatus(CompanyId $id, CompanyStatus $status): void
    {
        $company = EloquentCompany::findOrFail($id->get());
        $company->status = $status->name();
        $company->save();
    }
}
