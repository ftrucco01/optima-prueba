<?php

namespace Tests\OptimaCultura\Company\Routes;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class CreateNewCompanyRouteTest extends TestCase
{
    /**
     * @group route
     * @group access-interface
     * @test
     */
    #[Test]
    public function postCreateNewCompanyRoute()
    {
        /**
         * Preparing
         */
        $faker = \Faker\Factory::create();
        $testCompany = [
            'name'   => $faker->name,
            'status' => 'inactive',
        ];

        /**
         * Actions
         */
        $response = $this->json('POST', '/api/company', [
            'name' => $testCompany['name'],
        ]);

        /**
         * Asserts
         */
        $response->assertStatus(201)
            ->assertJsonFragment($testCompany);
    }
}
