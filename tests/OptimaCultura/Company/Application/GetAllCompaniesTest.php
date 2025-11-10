<?php

namespace Tests\OptimaCultura\Company\Application;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use OptimaCultura\Company\Application\GetAllCompanies;
use Tests\OptimaCultura\Company\Infrastructure\CompanyRepositoryFake;

final class GetAllCompaniesTest extends TestCase
{
    /**
     * @group application
     * @group company
     * @test
     */
    #[Test]
    public function get_all_companies_returns_array()
    {
        // Arrange
        $repository = new CompanyRepositoryFake();
        $service = new GetAllCompanies($repository);

        // Act
        $companies = $service->handle();

        // Assert
        $this->assertIsArray($companies);
        $this->assertEmpty($companies);
    }
}