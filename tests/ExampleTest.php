<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

final class ExampleTest extends TestCase
{
    public function test_equals_number()
    {
        $this->assertEquals(1, 1);
    }
}
