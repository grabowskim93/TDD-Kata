<?php

namespace App\Carpaccio\tests;

use App\Carpaccio\src\Carpaccio;
use PHPUnit\Framework\TestCase;

class CarpaccioTest extends TestCase
{
    private $amount = 100;
    private $price = 10.00;
    private $state = 'UT';

    private $carpaccio;


    public function setUp()
    {
        $this->carpaccio = new Carpaccio($this->amount, $this->price, $this->state);
    }

    public function testCarpaccioExist()
    {
        $carpaccio = new Carpaccio($this->amount, $this->price, $this->state);
        $carpaccioClass = $carpaccio instanceof Carpaccio;

        self::assertTrue($carpaccioClass);
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
        self::assertEquals(6.85, $this->carpaccio->getTax($this->state));
    }

    public function testTaxAmount()
    {
        $taxRate = $this->carpaccio->getTax($this->state) / 100;
        $taxAmount = $taxRate * $this->amount;

        self::assertEquals($taxAmount, $this->carpaccio->getTaxAmount($this->amount));
    }

    public function testDiscountRate()
    {
        $totalPrice = $this->amount * $this->price;
        self::assertEquals(3, $this->carpaccio->getDiscountRate($totalPrice));
    }

    public function testDiscountAmount()
    {
        $totalPrice = $this->amount * $this->price;

        $discountRate = $this->carpaccio->getDiscountRate($totalPrice);
        $discountAmount = ($totalPrice) * $discountRate;

        self::assertEquals($discountAmount, $this->carpaccio->getDiscountAmount($discountRate));
    }
}
