<?php

namespace Tests\OptimaCultura\Shared\ValueObject;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use OptimaCultura\Shared\ValueObject\Uuid;

final class UuidTest extends TestCase
{
    /**
     * @group value-object
     * @group shared
     * @test
     */
    #[Test]
    public function invalidUuid()
    {
        /**
         * Actions
         */
        $this->expectException(\Exception::class);
        new Uuid('😒');
    }


    /**
     * @group value-object
     * @group shared
     * @test
     */
    #[Test]
    public function generateAndconvertToStringUuid()
    {
        /**
         * Actions
         */
        $testUuid = Uuid::generate();

        $uuid = new Uuid((string) $testUuid);

        /**
         * Assert
         */
        $this->assertEquals($uuid->get(), $testUuid->get());
    }
}
