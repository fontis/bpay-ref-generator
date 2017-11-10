<?php

use PHPUnit\Framework\TestCase;
use Fontis\BpayRefGenerator\Generator;

class GeneratorTest extends TestCase
{
    public function testItGeneratesValidMod10V1()
    {
        $generator = new Generator();

        $number = $generator->calcMod10V1('1234567890');

        $this->assertSame('12345678903', $number);

    }

    public function testItGeneratesValidMod10V5()
    {
        $generator = new Generator();

        $number = $generator->calcMod10V5('1234567890');

        $this->assertSame('12345678905', $number);
    }
}
