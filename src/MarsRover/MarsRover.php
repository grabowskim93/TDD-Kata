<?php

declare(strict_types = 1);

namespace App\MarsRover;

/**
 * Class MarsRover
 * @package App\MarsRover\src
 */
class MarsRover
{
    /**
     * @var int
     */
    private $y;
    /**
     * @var int
     */
    private $x;

    /**
     * MarsRover constructor.
     * @param int $x
     * @param int $y
     */
    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return int
     */
    public function getY() : int
    {
        return $this->y;
    }

    /**
     * @return int
     */
    public function getX() : int
    {
        return $this->x;
    }

    /**
     * @param int $n
     * @param int $s
     * @param int $e
     * @param int $w
     * @throws \DomainException
     */
    public function validateCommandInput(int $n, int $s, int $e, int $w) : void
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

    /**
     * @param int $direction
     * @throws \DomainException
     */
    private function validateMoveInputRange(int $direction) : void
    {
        if (!in_array($direction, [0,1])) {
            throw new \DomainException('Wrong input value. Proper values: 0, 1');
        }
    }
}
