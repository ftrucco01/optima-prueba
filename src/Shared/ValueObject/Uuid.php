<?php

namespace OptimaCultura\Shared\ValueObject;

use Exception;
use Illuminate\Support\Str;

class Uuid
{
    /**
     * Regular expression pattern for matching a UUID of any variant.
     */
    private const VALID_PATTERN = '\A[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{12}\z';

    private string $uuid;

    public function __construct(string $uuid)
    {
        $this->uuid = $this->validate($uuid);
    }

    /**
     * Validate uuid
     */
    private function validate(string $uuid): string
    {
        if (!preg_match('/' . self::VALID_PATTERN . '/Dms', $uuid)) {
            throw new Exception('Invalid uuid');
        }

        return $uuid;
    }


    /**
     * Generate a new UUID
     */
    public static function generate()
    {
        return new self(Str::uuid());
    }

    /**
     * Retornar el valor
     */
    public function get()
    {
        return $this->uuid;
    }

    public function __toString(): string
    {
        return $this->get();
    }
}
