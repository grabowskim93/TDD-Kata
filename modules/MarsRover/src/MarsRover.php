<?php

namespace App;

class MarsRover
{

    private $y;
    private $x;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getY() : int
    {
        return $this->y;
    }

    public function getX() : int
    {
        return $this->x;
    }

    public function validateCommandInput(int $n, int $s, int $e, int $w)
    {
        if ($n === $s) {
            throw new \DomainException('Wrong move');
        }

        if ($e === $w) {
            throw new \DomainException('Wrong move');
        }

        $this->validateMoveInputRange($n);
        $this->validateMoveInputRange($s);
        $this->validateMoveInputRange($e);
        $this->validateMoveInputRange($w);
    }

    private function validateMoveInputRange($direction)
    {
        if (!in_array($direction, [0,1])) {
            throw new \DomainException('Wrong input value. Proper values: 0, 1');
        }
    }
}
