<?php

namespace OptimaCultura\Shared\Infrastructure\Interfaces;

use Illuminate\Contracts\Support\Arrayable as IlluminateArrayable;

interface Arrayable extends IlluminateArrayable
{
    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray();
}
