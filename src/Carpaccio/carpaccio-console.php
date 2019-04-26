<?php

//////////////////////////
/// //code
require 'Carpaccio.php';

use App\Carpaccio\src\Carpaccio;

$amount = $argv[1];
$price = $argv[2];
$state = $argv[3];

$initalTotalPrice = $amount * $price;

$carpaccio = new Carpaccio($amount, $price, $state);

echo 'start' . "\n";

echo 'initial price: ' . $initalTotalPrice . "\n";

$taxRate = $carpaccio->getTax($state) / 100;
echo 'tax rate: ' . $taxRate . "\n";

$discountRate = $carpaccio->getDiscountRate($initalTotalPrice) / 100;
echo 'discount rate: ' . $discountRate . "\n";

$discountAmount = $carpaccio->getDiscountAmount($discountRate);
echo 'discount amount: ' . $discountAmount . "\n";

$discountedPrice = $initalTotalPrice - $discountAmount;

$taxAmount = $carpaccio->getTaxAmount($discountedPrice);
echo 'tax amount: ' . $taxAmount . "\n";

echo 'total price: ' . ($discountedPrice + $taxAmount) . "\n";
