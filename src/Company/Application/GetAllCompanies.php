<?php

namespace OptimaCultura\Company\Application;

use OptimaCultura\Company\Domain\CompanyRepositoryInterface;
use OptimaCultura\Shared\Domain\Interfaces\ServiceInterface;

class GetAllCompanies implements ServiceInterface
{
    private CompanyRepositoryInterface $repository;

    public function __construct(CompanyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        return $this->repository->all();
    }
}