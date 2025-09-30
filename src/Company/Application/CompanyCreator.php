<?php

namespace OptimaCultura\Company\Application;

use OptimaCultura\Company\Domain\Company;
use OptimaCultura\Company\Domain\ValueObject\CompanyId;
use OptimaCultura\Company\Domain\ValueObject\CompanyName;
use OptimaCultura\Company\Domain\ValueObject\CompanyStatus;
use OptimaCultura\Company\Domain\CompanyRepositoryInterface;
use OptimaCultura\Shared\Domain\Interfaces\ServiceInterface;

class CompanyCreator implements ServiceInterface
{
    /**
     * @var CompanyRepositoryInterface $repository
     */
    private CompanyRepositoryInterface $repository;

    /**
     * Create new instance
     */
    public function __construct(CompanyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new company
     */
    public function handle($id, $name)
    {
        $company = new Company(
            new CompanyId($id),
            new CompanyName($name),
            CompanyStatus::disabled()
        );

        $this->repository->create($company);

        return $company;
    }
}
