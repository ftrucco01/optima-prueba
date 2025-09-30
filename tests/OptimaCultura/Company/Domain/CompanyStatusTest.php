<?php

namespace Tests\OptimaCultura\Company\Domain;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use OptimaCultura\Company\Domain\ValueObject\CompanyStatus;
use OptimaCultura\Company\Domain\Exception\InvalidCompanyStatusException;

final class CompanyStatusTest extends TestCase
{
    /**
     * @group domain
     * @group company
     * @test
     */
    #[Test]
    public function invalidCompanyStatusFromCode()
    {
        /**
         * Actions
         */
        $this->expectException(InvalidCompanyStatusException::class);
        new CompanyStatus(123485);
    }

    /**
     * @group domain
     * @group company
     * @test
     */
    #[Test]
    public function invalidCompanyStatusFromName()
    {
        /**
         * Actions
         */
        $this->expectException(InvalidCompanyStatusException::class);
        CompanyStatus::create('❤️🤫');
    }

    /**
     * @group domain
     * @group company
     * @test
     */
    #[Test]
    public function createActiveCompanyStatus()
    {
        /**
         * Actions
         */
        $status = CompanyStatus::create('active');

        /**
         * Assert
         */
        $this->assertEquals('active', $status->name());
        $this->assertEquals(1, $status->code());
    }

    /**
     * @group domain
     * @group company
     * @test
     */
    #[Test]
    public function createActiveFromCodeCompanyStatus()
    {
        /**
         * Actions
         */
        $status = CompanyStatus::create(1);

        /**
         * Assert
         */
        $this->assertEquals('active', $status->name());
        $this->assertEquals(1, $status->code());
        $this->assertEquals(['code' => 1, 'name' => 'active'], $status->toArray());
    }

    /**
     * @group domain
     * @group company
     * @test
     */
    #[Test]
    public function createEnabledCompanyStatus()
    {
        /**
         * Actions
         */
        $status = CompanyStatus::enabled();

        /**
         * Assert
         */
        $this->assertEquals('active', $status->name());
        $this->assertEquals(1, $status->code());
    }
}
