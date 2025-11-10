<?php

namespace Tests\OptimaCultura\Company\Application;

use Tests\TestCase;
use Illuminate\Support\Str;
use OptimaCultura\Company\Domain\ValueObject\CompanyId;
use OptimaCultura\Company\Domain\ValueObject\CompanyStatus;
use OptimaCultura\Company\Application\UpdateCompanyStatus;
use Tests\OptimaCultura\Company\Infrastructure\CompanyRepositoryFake;
use PHPUnit\Framework\Attributes\Test;

final class UpdateCompanyStatusTest extends TestCase
{
    #[Test]
    public function update_company_status_from_inactive_to_active()
    {
        // Arrange
        $repository = new CompanyRepositoryFake();
        $service = new UpdateCompanyStatus($repository);

        $id = new CompanyId((string) Str::uuid());
        $newStatus = CompanyStatus::fromName('active');

        // Act
        $service->handle($id, $newStatus);

        // Assert
        $this->assertTrue($repository->callMethodUpdateStatus);
        $this->assertEquals('active', $newStatus->name());
    }
}