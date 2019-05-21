<?php

declare(use_strict = 1);

namespace Test;

use App\StringCalculator\StringCalculator;
use PHPUnit\Framework\TestCase;

/**
 * Class StringCalculatorTest
 *
 * @package Test
 */
class StringCalculatorTest extends TestCase
{
    /**
     * @dataProvider calculatorComponentsProvider
     *
     * @param string $input
     * @param int $expected
     */
    public function testCalculatorAdd($input, $expected): void
    {
        $calculator = new StringCalculator();
        $sum = $calculator->add($input);
        $this->assertEquals($expected, $sum);
    }

    /**
     * @return \Generator
     */
    public function calculatorComponentsProvider()
    {
        yield 'Two components' => [
            'input' => '1,2',
            'expected' => 3
        ];

        yield 'One components' => [
            'input' => '1',
            'expected' => 1
        ];

        yield 'Empty' => [
            'input' => '',
            'expected' => 0
        ];

        yield 'Many numbers to add' => [
            'input' => '1,2,3,4,5,6,7',
            'expected' => 28
        ];

        yield 'New line' => [
            'input' => '1\n2,3',
            'expected' => 6
        ];

        yield 'Determine delimiter' => [
            'input' => '//;\n1;2',
            'expected' => 3
        ];
    }
}
