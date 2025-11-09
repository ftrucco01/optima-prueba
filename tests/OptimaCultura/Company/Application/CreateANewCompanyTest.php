<?php

namespace Tests\OptimaCultura\Company\Application;

use Tests\TestCase;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use OptimaCultura\Company\Domain\Company;
use OptimaCultura\Company\Application\CompanyCreator;
use Tests\OptimaCultura\Company\Infrastructure\CompanyRepositoryFake;

final class CreateANewCompanyTest extends TestCase
{
    /**
     * @group application
     * @group company
     * @test
     */
    #[Test]
    public function createANewCompany()
    {
        /**
         * Preparing
         */
        $faker = \Faker\Factory::create();
        $testCompany = [
            'id'      => Str::uuid(),
            'name'    => $faker->name,
            'status'  => 'inactive',
            'email'   => $faker->email,
            'address' => $faker->address
        ];

        /**
         * Actions
         */
        $creator = new CompanyCreator(new CompanyRepositoryFake());
        $company = $creator->handle(
            $testCompany['id'],
            $testCompany['name'],
            $testCompany['email'],
            $testCompany['address']
        );

        /**
         * Assert
         */
        $this->assertInstanceOf(Company::class, $company);
        $this->assertEquals($testCompany, $company->toArray());
    }
}
