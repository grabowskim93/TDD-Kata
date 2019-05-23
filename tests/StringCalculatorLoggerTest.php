<?php

declare(strict_types=1);

namespace Test;

use App\StringCalculator\StringCalculator;
use App\StringCalculator\StringCalculatorLogger;
use DomainException;
use Generator;
use PHPUnit\Framework\TestCase;

class StringCalculatorLoggerTest extends TestCase
{
    /**
     * Test log method
     */
    public function testLogger(): void
    {
        $mock = $this->createMock(StringCalculatorLogger::class);

        $mock->method('logSum')->willReturn(true);

        $this->assertEquals(true, $mock->logSum(3));
    }

    /**
     * @dataProvider calculatorComponentsProvider
     *
     * @param string $input
     * @param int    $expected
     *
     */
    public function testCalculatorAdd($input, $expected): void
    {
        $logger = $this->getMockBuilder(StringCalculatorLogger::class)
            ->setMethods(['logSum'])
            ->getMock();

        $logger->expects($this->once())
            ->method('logSum')
            ->willReturn(true);

        $calculator = new StringCalculator($logger);
        $calculator->add($input);
    }

    /**
     * @return Generator
     */
    public function calculatorComponentsProvider(): Generator
    {
        yield 'Test log sum' => [
            'input' => '1,2',
            'expected' => 3
        ];
    }

    /**
     * @return Generator
     */
    public function negativeNumbersProvider(): Generator
    {
        yield 'Negative number exception' => [
            'input' => '//;\n-1;-2',
            'expected' => DomainException::class
        ];
    }
}
