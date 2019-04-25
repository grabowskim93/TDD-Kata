<?php

namespace App;

class FizzBuzz
{
    public function getLines()
    {
        $lines = [];

        for ($i = 1; $i <= 100; $i++) {
            if (($i % 3 == 0) && ($i % 5 == 0)) {
                $lines[$i] = 'FizzBuzz';
            } elseif (($i % 3 == 0)) {
                $lines[$i] = 'Fizz';
            } elseif (($i % 5 == 0)) {
                $lines[$i] = 'Buzz';
            } else {
                $lines[$i] = $i;
            }
        }

        return $lines;
    }
}
