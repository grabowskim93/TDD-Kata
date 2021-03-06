<?php

namespace Tests;

use App\FizzBuzz\FizzBuzz;
use PHPUnit\Framework\TestCase;

class FizzBuzzTest extends TestCase
{
    public function testFizzBuzzClass()
    {
        $fizz = new FizzBuzz();

        self::assertTrue($fizz instanceof FizzBuzz);
    }

    public function testNumberOfFizzLines()
    {
        $fizz = new FizzBuzz();

        $lines = $fizz->getLines();

        self::assertCount(100, $lines);
    }

    public function testFizzMultipleOfThree()
    {
        $fizz = new FizzBuzz();

        $lines = $fizz->getLines();

        foreach ($lines as $lineKey => $line) {
            if ($lineKey % 3 == 0 && !($lineKey % 5 == 0)) {
                self::assertIsString($line);
                self::assertEquals('Fizz', $line);
            }
        }
    }

    public function testFizzMultipleOfFive()
    {
        $fizz = new FizzBuzz();

        $lines = $fizz->getLines();

        foreach ($lines as $lineKey => $line) {
            if ($lineKey % 5 == 0 && !($lineKey % 3 == 0)) {
                self::assertIsString($line);
                self::assertEquals('Buzz', $line);
            }
        }
    }

    public function testFizzMultipleOfFiveAndThree()
    {
        $fizz = new FizzBuzz();

        $lines = $fizz->getLines();

        foreach ($lines as $lineKey => $line) {
            if (($lineKey % 5 == 0) && ($lineKey % 3 == 0)) {
                self::assertIsString($line);
                self::assertEquals('FizzBuzz', $line);
            }
        }
    }
}
