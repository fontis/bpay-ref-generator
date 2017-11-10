<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Fontis\BpayRefGenerator\Generator;

class GeneratorTest extends TestCase
{
    private $generator;

    public function setUp() {
        $this->generator = new Generator();
    }

    public function testItGeneratesValidMod10V1()
    {
        $number = $this->generator->calcMod10V1('1234567890');

        $this->assertSame('12345678903', $number);

    }

    public function testItGeneratesValidMod10V5()
    {
        $number = $this->generator->calcMod10V5('1234567890');

        $this->assertSame('12345678905', $number);
    }
}
