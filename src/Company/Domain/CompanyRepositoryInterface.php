<?php

namespace OptimaCultura\Company\Domain;

interface CompanyRepositoryInterface
{
    /**
     * Persist a new company instance
     */
    public function create(Company $company): void;
}
