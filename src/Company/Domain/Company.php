<?php

namespace OptimaCultura\Company\Domain;

use OptimaCultura\Company\Domain\ValueObject\CompanyId;
use OptimaCultura\Company\Domain\ValueObject\CompanyName;
use OptimaCultura\Company\Domain\ValueObject\CompanyStatus;
use OptimaCultura\Shared\Infrastructure\Interfaces\Arrayable;

final class Company implements Arrayable
{
    /**
     * @var \OptimaCultura\Company\Domain\ValueObject\CompanyId
     */
    private CompanyId $id;

    /**
     * @var \OptimaCultura\Company\Domain\ValueObject\CompanyName
     */
    private CompanyName $name;

    /**
     * @var \OptimaCultura\Company\Domain\ValueObject\CompanyStatus
     */
    private CompanyStatus $status;

    public function __construct(
        CompanyId $id,
        CompanyName $name,
        CompanyStatus $status
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
    }

    /**
     * Get the company id
     */
    public function id(): CompanyId
    {
        return $this->id;
    }

    /**
     * Get the company name
     */
    public function name(): CompanyName
    {
        return $this->name;
    }

    /**
     * Get the company status
     */
    public function status(): CompanyStatus
    {
        return $this->status;
    }

    /**
     * Array representation of the company
     */
    public function toArray()
    {
        return [
            'id'       => $this->id()->get(),
            'name'     => $this->name()->get(),
            'status'   => $this->status()->name(),
        ];
    }
}
