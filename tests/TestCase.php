<?php

use PHPUnit\Framework\TestCase as FrameworkTestCase;

class TestCase extends FrameworkTestCase
{
    public function justReturnTrue(): void
    {
        $this->assertTrue(true);
    }
}
