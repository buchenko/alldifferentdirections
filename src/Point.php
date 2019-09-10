<?php

namespace buchenko\alldifferentdirections;

/**+
 * Class Point
 * @package buchenko\alldifferentdirections
 */
class Point
{
    /**
     * @var float
     */
    protected $x;

    /**
     * @var float
     */
    protected $y;


    /**
     * Point constructor.
     *
     * @param float $x
     * @param float $y
     */
    public function __construct(float $x = 0, float $y = 0)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return float
     */
    public function getX(): float
    {
        return $this->x;
    }

    /**
     * @param float $x
     */
    public function setX($x): void
    {
        $this->x = $x;
    }

    /**
     * @return float
     */
    public function getY(): float
    {
        return $this->y;
    }

    /**
     * @param float $y
     */
    public function setY($y): void
    {
        $this->y = $y;
    }

    /**
     * @return string
     */
    public function toPrint() : string
    {
        return "x: {$this->x}, y: {$this->y}";
    }
}