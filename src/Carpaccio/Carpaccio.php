<?php

declare(strict_types = 1);

namespace App\Carpaccio;

/**
 * Class Carpaccio
 * @package App\Carpaccio
 */
class Carpaccio
{
    /**
     * @var int $amount Pieces amount
     */
    private $amount;
    /**
     * @var float $price Price of single item
     */
    private $price;
    /**
     * @var string $state State symbol from which tax should be taken
     */
    private $state;

    /**
     * @var int $tax Tax value
     */
    private $tax = 0;

    /**
     * @var float|int $totalPrice Total price to pay
     */
    private $totalPrice;

    /**
     * Carpaccio constructor.
     * @param int $amount
     * @param float $price
     * @param string $state
     */
    public function __construct(int $amount, float $price, string $state)
    {
        $this->amount = $amount;
        $this->price = $price;
        $this->state = $state;
        $this->totalPrice = $amount * $price;
    }

    /**
     * @param string $state The symbol of US state
     *
     * @return float|int Tax value
     */
    public function getTax(string $state)
    {
        switch ($state) {
            case 'UT':
                $tax = 6.85;
                break;
            case 'NV':
                $tax = 8.00;
                break;
            case 'TX':
                $tax = 6.25;
                break;
            case 'AL':
                $tax = 4.00;
                break;
            case 'CA':
                $tax = 8.25;
                break;

            default:
                $tax = 0;
                break;
        }

        //@todo: refactor
        $this->tax = $tax;
        return $tax;
    }

    /**
     * @param int $price Tax value
     *
     * @return float|int Tax to pay
     */
    public function getTaxAmount(int $price)
    {
        $taxRate = $this->getTax($this->state) / 100;

        return $taxRate * $price;
    }

    /**
     * @param $priceBeforeDiscount
     *
     * @return int Value of discount
     */
    public function getDiscountRate(int $priceBeforeDiscount) : int
    {
        switch ($priceBeforeDiscount) {
            case $priceBeforeDiscount >= 1000 && $priceBeforeDiscount < 5000:
                $discountRate = 3;
                break;
            case $priceBeforeDiscount >= 5000 && $priceBeforeDiscount < 7000:
                $discountRate = 5;
                break;
            case $priceBeforeDiscount >= 7000 && $priceBeforeDiscount < 10000:
                $discountRate = 7;
                break;
            case $priceBeforeDiscount >= 10000 && $priceBeforeDiscount < 50000:
                $discountRate = 10;
                break;
            case $priceBeforeDiscount >= 50000:
                $discountRate = 15;
                break;

            default:
                $discountRate = 0;
                break;
        }

        return $discountRate;
    }

    /**
     * @param int $discountRate
     *
     * @return float|int
     */
    public function getDiscountAmount(int $discountRate)
    {
        $discountAmount = $discountRate * $this->totalPrice;

        return $discountAmount;
    }
}
