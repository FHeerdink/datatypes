<?php

namespace Fheerdink\DataTypes\Tests;

use Fheerdink\DataTypes\Guid;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class TestGuid extends TestCase
{
    public function testValidInitialisation()
    {
        $guidString = 'd50db124-10d0-4318-8a10-75172cbd44f5';
        $guid = new Guid($guidString);

        $this->assertEquals($guidString, $guid);
    }

    public function testInvalidInitialisation()
    {
        $this->expectException(InvalidArgumentException::class);

        (new Guid('test'));
    }

    public function testGenerate()
    {
        $this->assertInstanceOf(Guid::class, Guid::generate());
    }
}
