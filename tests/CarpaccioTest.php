<?php

namespace Tests;

use App\Carpaccio\Carpaccio;
use PHPUnit\Framework\TestCase;

class CarpaccioTest extends TestCase
{
    private $amount = 100;
    private $price = 10.00;
    private $state = 'UT';

    public function carpaccioProvider()
    {
        return [
            [
                100, 10.00, 'UT',
            ],
            [
                100, 50.00, 'TX',
            ],

            [
                70, 100.00, 'NV',

            ],
            [
                100, 100.00, 'CA',
            ],
            [
                1000, 100.00, 'AL',
            ],
            [
                100, 10.00, 'CALAS',
            ],
            [
                1, 1.00, 'CA',
            ]
        ];
    }

    public function testCarpaccioExist()
    {
        $carpaccio = new Carpaccio($this->amount, $this->price, $this->state);
        $carpaccioClass = $carpaccio instanceof Carpaccio;

        self::assertEquals(true, $carpaccioClass);
    }

    public function testInputStateArg()
    {
        self::assertIsString($this->state);
        self::assertEquals('2', strlen($this->state));
    }

    public function testInputPriceArg()
    {
        self::assertIsFloat($this->price);
        self::assertGreaterThan(0, $this->price);
    }

    public function testInputAmountArg()
    {
        self::assertIsInt($this->amount);
        self::assertGreaterThan(0, $this->amount);
    }

    public function testTaxPerState()
    {
        $carpaccio = new Carpaccio($this->amount, $this->price, $this->state);
        self::assertEquals(6.85, $carpaccio->getTax($this->state));
    }

    /**
     * @dataProvider carpaccioProvider
     * @param $amount
     * @param $price
     * @param $state
     */
    public function testTaxAmount($amount, $price, $state)
    {
        $carpaccio = new Carpaccio($amount, $price, $state);
        $taxRate = $carpaccio->getTax($state) / 100;
        $taxAmount = $taxRate * $amount;

        self::assertEquals($taxAmount, $carpaccio->getTaxAmount($amount));
    }

    /**
     * @dataProvider carpaccioProvider
     */
    public function testDiscountRate()
    {
        $carpaccio = new Carpaccio($this->amount, $this->price, $this->state);
        $totalPrice = $this->amount * $this->price;
        self::assertEquals(3, $carpaccio->getDiscountRate($totalPrice));
    }

    /**
     * @dataProvider carpaccioProvider
     * @param $amount
     * @param $price
     * @param $state
     */
    public function testDiscountAmount($amount, $price, $state)
    {
        $carpaccio = new Carpaccio($amount, $price, $state);
        $totalPrice = $amount * $price;

        $discountRate = $carpaccio->getDiscountRate($totalPrice);
        $discountAmount = ($totalPrice) * $discountRate;

        self::assertEquals($discountAmount, $carpaccio->getDiscountAmount($discountRate));
    }
}
