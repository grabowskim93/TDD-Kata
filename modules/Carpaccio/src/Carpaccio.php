<?php

namespace App\Carpaccio\src;

class Carpaccio
{
    private $amount;
    private $price;
    private $state;

    private $tax = 0;
    private $discountRate = 0;
    /**
     * @var float|int
     */
    private $totalPrice;

    public function __construct($amount, $price, $state)
    {
        $this->amount = $amount;
        $this->price = $price;
        $this->state = $state;
        $this->totalPrice = $amount * $price;
    }

    public function getTax($state)
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

    public function getTaxAmount($price)
    {
        $taxRate = $this->getTax($this->state) / 100;

        return $taxRate * $price;
    }

    public function getDiscountRate($priceBeforeDiscount)
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

    public function getDiscountAmount($discountRate)
    {
        $discountAmount = $discountRate * $this->totalPrice;

        return $discountAmount;
    }

    public function getTotalPrice()
    {
    }
}
